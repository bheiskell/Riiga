<?php
class LocationsController extends AppController {

  var $name = 'Locations';
  var $helpers = array('Html', 'Form');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view');

    // TODO: Make the is admin check less sucky
    if (!$this->Auth->user('is_admin')) {
    // TODO: Uncomment following line - used for testing
    //  $this->redirect(array('action' => 'index'));
    }
  }

  function admin_index() {
    $this->set('locations', $this->Location->findAllThreaded());
  }

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Location', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('location', $this->Location->read(null, $id));
  }

  function admin_add() {
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
    $this->set('locationTags', $this->Location->LocationTags->find('list'));
    $this->set('parents', $this->Location->generatetreelist(
      null, null, null, '|  '
    ));
  }

  function admin_edit($id = null) {
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
    $this->set('locationTags', $this->Location->LocationTags->find('list'));
    $this->set('parents', $this->Location->generatetreelist(
      null, null, null, '|  '
    ));
  }

  function admin_delete($id = null) {
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

  function admin_moveUp($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for Location', true));
      $this->redirect(array('action' => 'index'));
    }
    if ($this->Location->moveUp($id, 1)) {
      $this->Session->setFlash(__('Location moved', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__(
      'The Location could not be moved. Please, try again.', true
    ));
    $this->redirect(array('action' => 'index'));
  }

  function admin_moveDown($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for Location', true));
      $this->redirect(array('action' => 'index'));
    }
    if ($this->Location->moveDown($id, 1)) {
      $this->Session->setFlash(__('Location moved', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__(
      'The Location could not be moved. Please, try again.', true
    ));
    $this->redirect(array('action' => 'index'));
  }
}
?>
