<?php
class EntriesController extends AppController {

  var $name = 'Entries';
  var $helpers = array('Html', 'Form');
  var $paginate = array('order' => array('Entry.id' => 'desc'));

  function index() {
    $this->Entry->recursive = 0;
    $this->set('entries', $this->paginate());
  }

  function add($story_id = null) {

    if (!empty($this->data)) {
      $story_id = $this->data['Entry']['story_id'];
      $this->data['Entry']['user_id'] = $this->Auth->user('id');

      $this->Entry->create();
      if ($this->Entry->save($this->data)) {
        $this->Session->setFlash(__('The Entry has been saved', true));
        $this->redirect(array('controller' => 'stories', 'action' => 'view', 'id' => $story_id));
      } else {
        $this->Session->setFlash(__('The Entry could not be saved. Please, try again.', true));
      }
    }
    if (!$story_id) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('controller' => 'stories', 'action' => 'index'));
    }
    $characters = $this->Entry->Character->find('list');
    $stories = $this->Entry->Story->find('list');
    $users = $this->Entry->User->find('list');
    $this->set(compact('characters', 'stories', 'users'));

    $this->Entry->Story->recursive = 0;
    $this->set('story', $this->Entry->Story->read('name', $story_id));
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Entry', true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Entry->save($this->data)) {
        $this->Session->setFlash(__('The Entry has been saved', true));
        $this->redirect(array('controller' => 'stories', 'action' => 'view', 'id' => $this->data['Entry']['story_id']));
      } else {
        $this->Session->setFlash(__('The Entry could not be saved. Please, try again.', true));
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

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for Entry', true));
      $this->redirect(array('action' => 'index'));
    }
    if ($this->Entry->del($id)) {
      $this->Session->setFlash(__('Entry deleted', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('The Entry could not be deleted. Please, try again.', true));
    $this->redirect(array('action' => 'index'));
  }

}
?>
