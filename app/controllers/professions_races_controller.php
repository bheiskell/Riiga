<?php
class ProfessionsRacesController extends AppController {

	var $name = 'ProfessionsRaces';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->paginate['contain'] = array('Profession', 'Race');
		$this->set('professionsRaces', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ProfessionsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('professionsRace', $this->ProfessionsRace->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProfessionsRace->create();
			if ($this->ProfessionsRace->save($this->data)) {
				$this->Session->setFlash(__('The ProfessionsRace has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ProfessionsRace could not be saved. Please, try again.', true));
			}
		}
		$professions = $this->ProfessionsRace->Profession->find('list');
		$races = $this->ProfessionsRace->Race->find('list');
		$this->set(compact('professions', 'races'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ProfessionsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProfessionsRace->save($this->data)) {
				$this->Session->setFlash(__('The ProfessionsRace has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ProfessionsRace could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProfessionsRace->read(null, $id);
		}
		$professions = $this->ProfessionsRace->Profession->find('list');
		$races = $this->ProfessionsRace->Race->find('list');
		$this->set(compact('professions','races'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ProfessionsRace', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->ProfessionsRace->del($id)) {
			$this->Session->setFlash(__('ProfessionsRace deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The ProfessionsRace could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
