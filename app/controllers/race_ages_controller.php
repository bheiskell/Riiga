<?php
class RaceAgesController extends AppController {

	var $name = 'RaceAges';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->set('raceAges', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid RaceAge', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('raceAge', $this->RaceAge->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->RaceAge->create();
			if ($this->RaceAge->save($this->data)) {
				$this->Session->setFlash(__('The RaceAge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The RaceAge could not be saved. Please, try again.', true));
			}
		}
		$races = $this->RaceAge->Race->find('list');
		$this->set(compact('races'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid RaceAge', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RaceAge->save($this->data)) {
				$this->Session->setFlash(__('The RaceAge has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The RaceAge could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RaceAge->read(null, $id);
		}
		$races = $this->RaceAge->Race->find('list');
		$this->set(compact('races'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for RaceAge', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->RaceAge->del($id)) {
			$this->Session->setFlash(__('RaceAge deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The RaceAge could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
