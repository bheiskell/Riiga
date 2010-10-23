<?php
class ProfessionCategoriesController extends AppController {

	var $name = 'ProfessionCategories';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->set('professionCategories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ProfessionCategory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('professionCategory', $this->ProfessionCategory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProfessionCategory->create();
			if ($this->ProfessionCategory->save($this->data)) {
				$this->Session->setFlash(__('The ProfessionCategory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ProfessionCategory could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ProfessionCategory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProfessionCategory->save($this->data)) {
				$this->Session->setFlash(__('The ProfessionCategory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ProfessionCategory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProfessionCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ProfessionCategory', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->ProfessionCategory->del($id)) {
			$this->Session->setFlash(__('ProfessionCategory deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The ProfessionCategory could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
