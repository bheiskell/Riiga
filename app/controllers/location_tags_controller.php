<?php
class LocationTagsController extends AppController {

  var $name = 'LocationTags';
  var $helpers = array('Html', 'Form');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index');
  }

  function admin_index() {
    $this->set('locationTags', $this->paginate());
  }

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid LocationTag', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('locationTag', $this->LocationTag->read(null, $id));
  }

  function admin_add() {
    if (!empty($this->data)) {
      $this->LocationTag->create();
      if ($this->LocationTag->save($this->data)) {
        $this->Session->setFlash(__('The LocationTag has been saved', true));
        $this->redirect(array('action' => 'index'));
      }
    }
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid LocationTag', true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->LocationTag->save($this->data)) {
        $this->Session->setFlash(__('The LocationTag has been saved', true));
        $this->redirect(array('action' => 'index'));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->LocationTag->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for LocationTag', true));
      $this->redirect(array('action' => 'index'));
    }
    if ($this->LocationTag->del($id)) {
      $this->Session->setFlash(__('LocationTag deleted', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(
      __('The LocationTag could not be deleted. Please, try again.', true)
    );
    $this->redirect(array('action' => 'index'));
  }
}
?>
