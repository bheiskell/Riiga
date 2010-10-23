<?php
class CharactersController extends AppController {

  var $name = 'Characters';

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
  }

  function index() {
    $this->paginate['contain'] = array('User');
    $this->set('characters', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Character', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Character->contain(array(
      'Faction', 'Location', 'Race', 'Rank', 'User',
    ));
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

    $this->_form();
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

    $this->_form();
  }

  function _form() {
    // Tmps to reduce line length
    $c = $this->Character;
    $p = $this->Character->Race->ProfessionsRace;
    $this->set('user_rank', $this->Auth->user('rank'));

    $this->set('users', $c->User->find('list'));
    $this->set('ranks', $c->Rank->find('list'));

    $this->set('races',     $c->Race    ->getGroupedByRank());
    $this->set('locations', $c->Location->getGroupedByRank());
    $this->set('factions',  $c->Faction ->getGroupedByRace());

    $this->set('ageInfo',  $c->Race->RaceAge->find('all'));
    $this->set('raceInfo', $c->Race         ->find('all'));

    $this->set('locationInfo', $c->Location->CharacterLocation->find('all'));
    $this->set('locationsRaces', $c->Race->LocationsRace->getGroupedByRace());

    $this->set('factionRanks', $c->Faction->FactionRank->getGroupedByFaction());
    $this->set('factionInfo', $c->Faction->find('all'));

    $this->set('professionInfo', $p->Profession->getGroupedByCategory());
    $this->set('raceNames', $c->Race->find('list'));

    $this->render('form');
  }
}
?>
