<?php
class StoriesController extends AppController {

  var $name = 'Stories';
  var $helpers = array('Html', 'Form');
  var $paginate = array('order' => array('Story.id' => 'desc'));

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');
  }

  function index() {
    $this->Story->recursive = 0;
    $this->set('stories', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('action' => 'index'));
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
    // TODO: Default the Turn to your user
    if (!empty($this->data)) {
      $this->Story->create();
      if ($this->Story->save($this->data)) {
        $this->Session->setFlash(__('Story saved.', true));
        $this->redirect(array('action' => 'view', 'id' => $this->Story->id));
      }
    }
    $characters = $this->Story->Character->find('list');
    $users = $this->Story->User->find('list');
    $turns = $this->Story->Turn->find('list');
    $this->set(compact('characters', 'users', 'turns'));
  }

  function edit($id = null) {
    // TODO: Check that user is in the users section and is moderator.
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Story->save($this->data)) {
        $this->Session->setFlash(__('The Story has been saved.', true));
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
}
?>
