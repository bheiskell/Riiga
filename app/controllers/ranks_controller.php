<?php
class RanksController extends AppController {

	var $name = 'Ranks';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Rank->recursive = 0;
		$this->set('ranks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Rank', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rank', $this->Rank->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Rank->create();
			if ($this->Rank->save($this->data)) {
				$this->Session->setFlash(__('The Rank has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Rank could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Rank', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Rank->save($this->data)) {
				$this->Session->setFlash(__('The Rank has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Rank could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rank->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Rank', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Rank->del($id)) {
			$this->Session->setFlash(__('Rank deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Rank could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>