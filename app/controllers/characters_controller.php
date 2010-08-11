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

    $this->set('races', $this->Character->Race->find('list', array(
      'fields' => array('id', 'name', 'rank_id'),
      'order' => array('rank_id'),
    )));

    $this->set('locations', $this->Character->Location->find('list', array(
      'joins'  => array(array(
        'table' => 'character_locations',
        'alias' => 'CharacterLocation',
        'type' => 'INNER',
        'conditions' => array('Location.id = CharacterLocation.location_id')
      )),
      'fields' => array('id', 'name', 'CharacterLocation.rank_id'),
      'order' => array('rank_id'),
    )));

    foreach(array_keys($this->viewVars['races']) as $key) {
      $this->viewVars['races']["Rank {$key}"] = $this->viewVars['races'][$key];
      unset($this->viewVars['races'][$key]);
    }

    foreach(array_keys($this->viewVars['locations']) as $key) {
      $this->viewVars['locations']["Rank {$key}"] =
        $this->viewVars['locations'][$key];
      unset($this->viewVars['locations'][$key]);
    }

    $this->set('factions', $this->Character->Faction->find('list', array(
      'joins'  => array(
        array(
          'table' => 'factions_races',
          'alias' => 'FactionsRace',
          'type' => 'INNER',
          'conditions' => array('Faction.id = FactionsRace.faction_id')
        ),
        array(
          'table' => 'races',
          'alias' => 'Race',
          'type' => 'INNER',
          'conditions' => array('Race.id = FactionsRace.race_id')
        ),
      ),
      'fields' => array('id', 'name', 'Race.name'),
    )));
  }
}
?>
