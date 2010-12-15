<?php
class CharactersController extends AppController {

  var $name = 'Characters';
  var $paginate = array(
    'contain' => array('User', 'Rank', 'Location', 'Race', 'Faction')
  );

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
  }

  function index() {
    $this->paginate['order'] = array('User.created' => 'DESC');
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
    if ($this->Character->approvePending($pending_id)) {
      $this->Session->setFlash(__('Character Approved', true));
      $this->redirect(array(
        'admin'  => false,
        'action' => 'view',
        $this->Character->id,
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
      'Rank',
      'User',
    );

    if ($id) {
      $contain[] = 'Story';
      $this->Character->contain($contain);
      $this->set('character', $this->Character->findById($id));

    } else if (isset($this->params['named']['pending_id'])) {
      $this->Character->contain($contain);
      $id = $this->params['named']['pending_id'];
      $this->set('character', $this->Character->Pending->findByPendingId($id));
    }

    if (empty($this->viewVars['character'])) {
      $this->cakeError('error404');
    }
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
        $this->Session->setFlash(__(
          'Your character has been saved and is now awaiting approval.', true
        ));
        $this->redirect(array(
          'action' => 'view',
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

    // TODO: pull down location tags

    $this->set('user_rank',
      $this->Character->User->getRank($this->Auth->user('id'))
    );

    $users = $this->Character->User->find('list');
    $ranks = $this->Character->Rank->find('list');

    $races     = $this->Character->Race    ->find('group_by_rank');
    $locations = $this->Character->Location->find('group_by_rank');
    $factions  = $this->Character->Faction ->find('group_by_race');

    $raceInfo     = $this->Character->Race->find('all');
    $factionInfo  = $this->Character->Faction->find('all');
    $ageInfo      = $this->Character->Race->RaceAge->find('all');

    $locationInfo = $this->Character->Location->find('info_for_characters');

    $professionInfo = $this->Character->Race->ProfessionsRace
                           ->Profession->find('group_by_category');
    $factionRanks
      = $this->Character->Faction->FactionRank->find('group_by_faction');

    $raceNames = $this->Character->Race->find('list');

    $this->set(compact(
      'ageInfo',         'factions',       'factionInfo',    'factionRanks',
      'locations',       'locationInfo',   'professionInfo', 'races',
      'raceNames',       'raceInfo',       'ranks',          'users'
    ));

    $this->render('form');
  }
}
?>
