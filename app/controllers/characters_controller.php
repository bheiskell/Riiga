<?php
class CharactersController extends AppController {

  var $name = 'Characters';
  var $paginate = array(
    'contain' => array('User', 'Rank', 'Location', 'Race', 'Faction'),
    'order' => array('Character.created' => 'DESC'),
  );

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
  }

  function index() {
    $this->set('characters', $this->paginate());

    // Not paginating pending, because this list should never be very long.
    // Also, I don't know how to do two paginations on the same page.
    $this->set('pendingCharacters',
      $this->Character->Pending->findAllByUserId($this->Auth->user('id'))
    );
  }

  function admin_index() {
    $this->set('characters', $this->paginate($this->Character->Pending));
    $this->render('index');
  }

  function admin_approve_pending($pending_id = null) {
    $user_id = $this->Character->Pending->field('user_id', $pending_id);
    $name = $this->Character->Pending->field('name', $pending_id);
    if ($this->Character->approvePending($pending_id)) {
      $message = $this->_sendMessage(
        $user_id,
        "You can now begin using \"$name\" by adding him/her to a story. "
        . "If you haven't found a story to join, consider sending an open "
        . "invitation in the chat box in the footer.",
        'Your character has been approved!'
      ) ? 'Character Approved' : 'Failed to Message User';

      $this->flash($message, array(
        'admin'  => false,
        'action' => 'view',
        $this->Character->field('slug'),
      ));

    } else {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index', 'admin' => false));
    }
  }

  function view($id = null) {
    $contain = array(
      'Faction',
      'Location' => array('LocationRegion'),
      'Race',
      'Subrace',
      'Rank',
      'FactionRank',
      'User',
    );

    if ($id) {
      $contain[] = 'Story';
      $this->Character->contain($contain);
      $this->set('character', $this->Character->findBySlug($id));

    } else if (isset($this->params['named']['pending_id'])) {
      $this->Character->contain($contain);
      $id = $this->params['named']['pending_id'];
      $this->set('character', $this->Character->Pending->findBySlug($id));
    }

    if (empty($this->viewVars['character'])) {
      $this->cakeError('error404');
    }

    $this->pageTitle
      = 'Characters - ' . $this->viewVars['character']['Character']['name'];
  }

  function add ($id = false) { $this->_form($id); }
  function edit($id = false) { $this->_form($id); }

  function _form($id) {
    if (!empty($this->data)) {

      // When working with an existing character, need to verify the original
      // user_id matches the currently authenticated user.
      if ($this->data['Character']['id']) {
        $this->Character->id = $this->data['Character']['id'];
        if (!$this->_isOwner($this->Character->field('user_id'))) {
          $this->cakeError('error403');
        }
      }

      $this->data['Character']['user_id'] = $this->Auth->user('id');

      if ($this->Character->savePending($this->data)) {
        $this->Message->sendToAdmins(
          $this->Auth->user('id'),
          'Click "Characters" in the admin bar.',
          'Characters pending approval!'
        );
        $this->redirect(array(
          'controller' => 'pages',
          'action'     => 'character_pending',
          'pending_id' => $this->Character->Pending->id,
        ));
      } else {
        $this->Session->setFlash(__(
          'There was a problem with your submission.', true
        ));
      }

    } else if (isset($this->params['named']['pending_id'])) {
      $pending_id = $this->params['named']['pending_id'];
      $this->data = $this->Character->Pending->findByPendingId($pending_id);

    } else if ($id) {
      $this->data = $this->Character->findById($id);

      // Courtesy error - real prevention is above
      if (!$this->_isOwner($this->data['Character']['user_id'])) {
        $this->Session->setFlash(__('This is not your character.', true));
        $this->redirect(array('action' => 'index'));
      }
    }

    // TODO: move these; placing containments here like this feels hack.
    $this->Character->Race->RaceAge->contain(array('Race'));
    $this->Character->Race->ProfessionsRace->Profession->contain(array(
      'ProfessionsRace'
    ));

    $this->set('user_rank',
      $this->Character->User->getRank($this->Auth->user('id'))
    );

    $users = $this->Character->User->find('list');
    $ranks = $this->Character->Rank->find('list');

    $races     = $this->Character->Race    ->find('group_by_rank');
    $subraces  = $this->Character->Subrace ->find('group_by_race');
    $locations = $this->Character->Location->find('group_by_rank');
    $factions  = $this->Character->Faction ->find('group_by_race');
    $faction_ranks = $this->Character->FactionRank
      ->find('group_by_faction_name', 'list');

    $raceInfo     = $this->Character->Race->find('all');
    $subraceInfo  = $this->Character->Subrace->find('all');
    $factionInfo  = $this->Character->Faction->find('all');
    $ageInfo      = $this->Character->Race->RaceAge->find('all');

    $locationInfo = $this->Character->Location->find('info_for_characters');

    $professionInfo = $this->Character->Race->ProfessionsRace
                           ->Profession->find('group_by_category');
    $factionRanksInfo = $this->Character->FactionRank->find('group_by_faction');

    $raceNames = $this->Character->Race->find('list');

    $this->set(compact(
      'ageInfo',         'factions',       'factionInfo',    'factionRanksInfo',
      'locations',       'locationInfo',   'professionInfo', 'races',
      'raceNames',       'raceInfo',       'ranks',          'faction_ranks',
      'subraces',        'subraceInfo',    'users'
    ));

    $this->render('form');
  }
}
?>
