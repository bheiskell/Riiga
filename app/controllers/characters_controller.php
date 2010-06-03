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
        $this->flash(__('Character saved.', true));
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
      $this->flash(__('Invalid Character', true), array('action' => 'index'));

    } else if ($this->Auth->user('id') != $this->Character->field('user_id')) {
      $this->flash(
        __('This character does not belong to you.', true),
        array('action' => 'index')
      );
    }
    if (!empty($this->data)) {
      if ($this->Character->save($this->data)) {
        $this->flash(__('The Character has been saved.', true));
        $this->redirect(array(
          'action' => 'view',
          'id' => $this->Character->id
        ));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Character->read(null, $id);
    }
    $this->set('users', $this->Character->User->find('list'));
  }
}
?>
