<?php
class RacesController extends AppController {

	var $name = 'Races';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->Race->recursive = 0;
		$this->set('races', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Race', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('race', $this->Race->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Race->create();
			if ($this->Race->save($this->data)) {
				$this->Session->setFlash(__('The Race has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Race could not be saved. Please, try again.', true));
			}
		}
		$ranks = $this->Race->Rank->find('list');
		$this->set(compact('ranks'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Race', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Race->save($this->data)) {
				$this->Session->setFlash(__('The Race has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Race could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Race->read(null, $id);
		}
		$ranks = $this->Race->Rank->find('list');
		$this->set(compact('ranks'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Race', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Race->del($id)) {
			$this->Session->setFlash(__('Race deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Race could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
