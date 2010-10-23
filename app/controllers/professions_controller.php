<?php
class ProfessionsController extends AppController {

	var $name = 'Professions';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->paginate['contain'] = array('ProfessionCategory');
		$this->set('professions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Profession', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('profession', $this->Profession->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Profession->create();
			if ($this->Profession->save($this->data)) {
				$this->Session->setFlash(__('The Profession has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Profession could not be saved. Please, try again.', true));
			}
		}
		$professionCategories = $this->Profession->ProfessionCategory->find('list');
		$this->set(compact('professionCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Profession', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Profession->save($this->data)) {
				$this->Session->setFlash(__('The Profession has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Profession could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Profession->read(null, $id);
		}
		$professionCategories = $this->Profession->ProfessionCategory->find('list');
		$this->set(compact('professionCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Profession', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Profession->del($id)) {
			$this->Session->setFlash(__('Profession deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Profession could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
