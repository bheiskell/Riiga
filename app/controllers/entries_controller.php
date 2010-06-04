<?php
class EntriesController extends AppController {

  var $name = 'Entries';
  var $helpers = array('Html', 'Form');
  var $paginate = array('order' => array('Entry.id' => 'desc'));

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index');
  }

  function index() {
    $this->Entry->recursive = 0;
    $this->set('entries', $this->paginate());
  }

  function add($story_id = null) {
    // TODO: Check that you are part of the Storie's Character's Users
    if (!empty($this->data)) {
      $this->data['Entry']['user_id'] = $this->Auth->user('id');

      $this->Entry->create();
      if ($this->Entry->save($this->data)) {
        $this->Session->setFlash(__('The Entry has been saved', true));
        $this->redirect(array(
          'controller' => 'stories',
          'action' => 'view',
          'id' => $this->Entry->storyId
        ));
      }
    }
    if (!$story_id && !isset($this->data['Entry']['story_id'])) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('controller' => 'stories', 'action' => 'index'));
    }
    $this->set('characters', $this->Entry->Character->find('list'));

    $this->Entry->Story->recursive = 0;
    $this->set('story', $this->Entry->Story->findById($story_id));
  }

  function edit($id = null) {

    // TODO: Check that this is your post
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Entry', true));
      $this->redirect(array('action' => 'index'));
    }

    if (!empty($this->data)) {
      if ($this->Entry->save($this->data)) {
        $this->Session->setFlash(__('The Entry has been saved', true));
        $this->redirect(array(
          'controller' => 'stories',
          'action' => 'view',
          'id' => $this->Entry->storyId
        ));
      }
    }
    if (empty($this->data) && !($this->data = $this->Entry->read(null, $id))) {
      $this->redirect(array('action' => 'index'));
    }
    $characters = $this->Entry->Character->find('list');
    $stories = $this->Entry->Story->find('list');
    $users = $this->Entry->User->find('list');
    $this->set(compact('characters','stories','users'));
  }
}
?>
