<?php
class StoriesController extends AppController {

  var $name = 'Stories';
  var $helpers = array('Html', 'Form');

  function beforeFilter() {
    parent::beforeFilter();
    // TODO: Add admin / story admin checks here
  }

  function index() {
    $this->Story->recursive = 0;
    $this->set('stories', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->flash(__('Invalid Story', true), array('action' => 'index'));
    }

    // Hack: Wasteful queries in my opinion. If this turns out not to scale 
    // well, I'll have to come back and replicate these results manually with
    // a few well crafted queries.
    $this->Story->Behaviors->attach('Containable');
    $this->Story->recursive = 2;
    $this->Story->contain(array('Turn', 'User', 'Character', 'Character.User', 
                                'Entry', 'Entry.Character', 'Entry.User'));
    $story     = $this->Story->findById($id);
    $this->set(compact('story'));
  }

  function add() {
    if (!empty($this->data)) {
      $this->Story->create();
      if ($this->Story->save($this->data)) {
        $this->flash(__('Story saved.', true), array('action' => 'index'));
        $this->redirect(array('action' => 'view', 'id' => $this->Story->id));
      } else {
      }
    }
    $characters = $this->Story->Character->find('list');
    $users = $this->Story->User->find('list');
    $turns = $this->Story->Turn->find('list');
    $this->set(compact('characters', 'users', 'turns'));
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->flash(__('Invalid Story', true), array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Story->save($this->data)) {
        $this->flash(__('The Story has been saved.', true), array('action' => 'index'));
        $this->redirect(array('action' => 'view', 'id' => $this->Story->id));
      } else {
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Story->read(null, $id);
    }
    $characters = $this->Story->Character->find('list');
    $users = $this->Story->User->find('list');
    $turns = $this->Story->Turn->find('list');
    $this->set(compact('characters','users','turns'));
  }

  function delete($id = null) {
    if (!$id) {
      $this->flash(__('Invalid Story', true), array('action' => 'index'));
    }
    if ($this->Story->del($id)) {
      $this->flash(__('Story deleted', true), array('action' => 'index'));
    }
    $this->flash(__('The Story could not be deleted. Please, try again.', true), array('action' => 'index'));
  }

}
?>
