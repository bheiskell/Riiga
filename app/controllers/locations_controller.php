<?php
class LocationsController extends AppController {

  var $name = 'Locations';
  var $helpers = array('Html', 'Form');

  function index() {
    $this->Location->recursive = 0;
    $this->set('locations', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Location', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('location', $this->Location->read(null, $id));
  }

  function add() {
    if (!empty($this->data)) {
      $this->Location->create();
      if ($this->Location->save($this->data)) {
        $this->Session->setFlash(__('The Location has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__(
          'The Location could not be saved. Please, try again.', true
        ));
      }
    }
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Location', true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Location->save($this->data)) {
        $this->Session->setFlash(__('The Location has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__(
          'The Location could not be saved. Please, try again.', true
        ));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Location->read(null, $id);
    }
  }

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for Location', true));
      $this->redirect(array('action' => 'index'));
    }
    if ($this->Location->del($id)) {
      $this->Session->setFlash(__('Location deleted', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__(
      'The Location could not be deleted. Please, try again.', true
    ));
    $this->redirect(array('action' => 'index'));
  }

}
?>
