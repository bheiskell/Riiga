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
    $this->set('characters', $this->paginate());
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
        'action' => 'view',
        $this->Character->id,
        'admin' => false,
      ));

    } else {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index', 'admin' => false));
    }
  }

  function view($id = null) {
    $contain = array('Faction', 'Location', 'Race', 'Rank', 'User', 'Story');

    if ($id) {
      $this->Character->contain($contain);
      $this->set('character', $this->Character->findById($id));

    } else if (isset($this->params['named']['pending_id'])) {
      $id = $this->params['named']['pending_id'];
      $this->Character->contain($contain);
      $this->set('character', $this->Character->Pending->findByPendingId($id));

    } else {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index'));
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
        if (!$this->_isAllowed($this->Character->field('user_id'))) {
          $this->cakeError('error500');
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
      if (!$this->_isAllowed($this->data['Character']['user_id'])) {
        $this->Session->setFlash(__('This is not your character.', true));
        $this->redirect(array('action' => 'index'));
      }
    }

    // TODO: move these; placing containments here like this feels hack.
    $this->Character->Race->RaceAge->contain(array('Race'));
    $this->Character->Race->ProfessionsRace->Profession->contain(array(
      'ProfessionsRace'
    ));
    $this->Character->Location->CharacterLocation->contain(array(
      'Location' => array('LocationRegion'),
      'Rank',
    ));

    $this->set('user_rank', $this->Auth->user('rank'));

    $users = $this->Character->User->find('list');
    $ranks = $this->Character->Rank->find('list');

    $races     = $this->Character->Race->getGroupedByRank();
    $locations = $this->Character->Location->getGroupedByRank();
    $factions  = $this->Character->Faction->getGroupedByRace();

    $raceInfo     = $this->Character->Race->find('all');
    $factionInfo  = $this->Character->Faction->find('all');
    $ageInfo      = $this->Character->Race->RaceAge->find('all');
    $locationInfo = $this->Character->Location->CharacterLocation->find('all');

    $locationsRaces = $this->Character->Race->LocationsRace->getGroupedByRace();
    $professionInfo = $this->Character->Race->ProfessionsRace
                           ->Profession->getGroupedByCategory();
    $factionRanks   = $this->Character->Faction->FactionRank
                           ->getGroupedByFaction();

    $raceNames = $this->Character->Race->find('list');

    $this->set(compact(
      'ageInfo',   'factions',     'factionInfo',    'factionRanks',
      'locations', 'locationInfo', 'locationsRaces', 'professionInfo',
      'races',     'raceNames',    'raceInfo',       'ranks',
      'users'
    ));

    $this->render('form');
  }
}
?>
