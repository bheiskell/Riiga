<?php
class LocationsController extends AppController {
  var $name = 'Locations';
  var $scaffold = 'admin';

  function admin_index() {
    $this->set('locations', $this->Location->findAllThreaded());
  }

  function admin_add()     { $this->_form(); }
  function admin_edit($id) { $this->_form($id); }

  function _form($id = false) {
    if (!empty($this->data)) {
      if (!$this->Location->id) { $this->Location->create(); }

      if ($this->Location->save($this->data)) {
        $this->data['LocationRegion']['location_id'] = $this->Location->id;
        $this->Location->LocationRegion->save($this->data);

        $this->Session->setFlash(__('The Location has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__(
          'The Location could not be saved. Please, try again.', true
        ));
      }

    } else if($id) {
      $this->Location->contain(array('LocationRegion', 'LocationTag'));
      $this->data = $this->Location->read(null, $id);
    }

    $this->set('locationTags', $this->Location->LocationTag->find('list'));
    $this->set('parents', $this->Location->generatetreelist(
      null, null, null, '|  '
    ));
    $this->set('depth', count($this->Location->getpath()));

    $this->render('admin_form');
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
