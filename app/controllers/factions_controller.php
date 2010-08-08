<?php
class FactionsController extends AppController {

	var $name = 'Factions';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->Faction->recursive = 0;
		$this->set('factions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Faction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('faction', $this->Faction->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Faction->create();
			if ($this->Faction->save($this->data)) {
				$this->Session->setFlash(__('The Faction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Faction could not be saved. Please, try again.', true));
			}
		}
		$races = $this->Faction->Race->find('list');
		$this->set(compact('races'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Faction', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Faction->save($this->data)) {
				$this->Session->setFlash(__('The Faction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Faction could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Faction->read(null, $id);
		}
		$races = $this->Faction->Race->find('list');
		$this->set(compact('races'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Faction', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Faction->del($id)) {
			$this->Session->setFlash(__('Faction deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Faction could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
