<?php
class LocationsRacesController extends AppController {

	var $name = 'LocationsRaces';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->set('locationsRaces', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid LocationsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('locationsRace', $this->LocationsRace->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->LocationsRace->create();
			if ($this->LocationsRace->save($this->data)) {
				$this->Session->setFlash(__('The LocationsRace has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The LocationsRace could not be saved. Please, try again.', true));
			}
		}
		$locations = $this->LocationsRace->CharacterLocation->find('list', array(
			'fields' => array('Location.id', 'Location.name'),
			'joins' => array(
				array(
					'table' => 'locations',
					'alias' => 'Location',
					'type'  => 'INNER',
					'conditions' => array('Location.id = CharacterLocation.location_id')
				),
			),
		));
		$races = $this->LocationsRace->Race->find('list');
		$this->set(compact('locations', 'races'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LocationsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->LocationsRace->save($this->data)) {
				$this->Session->setFlash(__('The LocationsRace has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The LocationsRace could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LocationsRace->read(null, $id);
		}
		$locations = $this->LocationsRace->Location->find('list');
		$races = $this->LocationsRace->Race->find('list');
		$this->set(compact('locations','races'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for LocationsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->LocationsRace->del($id)) {
			$this->Session->setFlash(__('LocationsRace deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The LocationsRace could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
