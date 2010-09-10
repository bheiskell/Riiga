<?php
class CharactersController extends AppController {

  var $name = 'Characters';
  var $helpers = array('Html', 'Form');
  var $paginate = array('order' => array('Character.id' => 'desc'));

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
  }

  function index() {
    $this->Character->recursive = 1;
    $this->set('characters', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('character', $this->Character->read(null, $id));
  }

  function add() {
    if (!empty($this->data)) {
      $this->data['Character']['user_id'] = $this->Auth->user('id');
      $this->Character->create();
      if ($this->Character->save($this->data)) {
        $this->Session->setFlash(__('Character saved.', true));
        $this->redirect(array(
          'action' => 'view',
          'id' => $this->Character->id
        ));
      }
    }
    $this->set('users', $this->Character->User->find('list'));
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index'));

    } else if ($this->Auth->user('id') != $this->Character->field('user_id')) {
      $this->Session->setFlash(__("This is not your character.", true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Character->save($this->data)) {
        $this->Session->setFlash(__('The Character has been saved.', true));
        $this->redirect(array(
          'action' => 'view',
          'id' => $this->Character->id
        ));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Character->read(null, $id);
    }
    $this->set('user_rank', 3);
    $this->set('users', $this->Character->User->find('list'));
    $this->set('ranks', $this->Character->Rank->find('list'));

    $this->set('races',     $this->Character->Race->find('grouped'));
    $this->set('locations', $this->Character->Location->find('grouped'));
    $this->set('factions',  $this->Character->Faction->find('grouped'));

    $this->set('factionRanks',
      $this->Character->Faction->FactionRank->find('all')
    );

    $this->set('locationsRaces',
      $this->Character->Race->LocationsRace->find('all')
    );

    $this->set('raceAges', $this->Character->Race->RaceAge->find('all'));

    //$this->set('professions',
      //$this->Character->Race->ProfessionsRace->find('table')
    //);
    // arrayy race => array category => array profession, age
  }
}
?>
