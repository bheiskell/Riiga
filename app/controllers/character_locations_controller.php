<?php
class CharacterLocationsController extends AppController {

	var $name = 'CharacterLocations';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->CharacterLocation->recursive = 0;
		$this->set('characterLocations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid CharacterLocation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('characterLocation', $this->CharacterLocation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CharacterLocation->create();
			if ($this->CharacterLocation->save($this->data)) {
				$this->Session->setFlash(__('The CharacterLocation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The CharacterLocation could not be saved. Please, try again.', true));
			}
		}
		$locations = $this->CharacterLocation->Location->find('list');
		$ranks = $this->CharacterLocation->Rank->find('list');
		$this->set(compact('locations', 'ranks'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid CharacterLocation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CharacterLocation->save($this->data)) {
				$this->Session->setFlash(__('The CharacterLocation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The CharacterLocation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CharacterLocation->read(null, $id);
		}
		$locations = $this->CharacterLocation->Location->find('list');
		$ranks = $this->CharacterLocation->Rank->find('list');
		$this->set(compact('locations','ranks'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for CharacterLocation', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->CharacterLocation->del($id)) {
			$this->Session->setFlash(__('CharacterLocation deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The CharacterLocation could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>