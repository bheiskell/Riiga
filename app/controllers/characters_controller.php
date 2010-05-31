<?php
class CharactersController extends AppController {

  var $name = 'Characters';
  var $helpers = array('Html', 'Form');

  function index() {
    $this->Character->recursive = 0;
    $this->set('characters', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->flash(__('Invalid Character', true), array('action' => 'index'));
    }
    $this->set('character', $this->Character->read(null, $id));
  }

  function add() {
    if (!empty($this->data)) {
      $this->data['Character']['user_id'] = $this->Auth->user('id');
      $this->Character->create();
      if ($this->Character->save($this->data)) {
        $this->flash(__('Character saved.', true), array('action' => 'index'));
        $this->redirect(array('action' => 'view', 'id' => $this->Character->id));
      } else {
      }
    }
    $users = $this->Character->User->find('list');
    $this->set(compact('users'));
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->flash(__('Invalid Character', true), array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Character->save($this->data)) {
        $this->flash(__('The Character has been saved.', true), array('action' => 'index'));
        $this->redirect(array('action' => 'view', 'id' => $this->Character->id));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Character->read(null, $id);
    }
    $users = $this->Character->User->find('list');
    $this->set(compact('users'));
  }

  function delete($id = null) {
    if (!$id) {
      $this->flash(__('Invalid Character', true), array('action' => 'index'));
    }
    if ($this->Character->del($id)) {
      $this->flash(__('Character deleted', true), array('action' => 'index'));
    }
    $this->flash(__('The Character could not be deleted. Please, try again.', true), array('action' => 'index'));
  }

}
?>
