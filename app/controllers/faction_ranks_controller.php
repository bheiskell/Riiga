<?php
class FactionRanksController extends AppController {

	var $name = 'FactionRanks';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->paginate['contain'] = array('Faction', 'Rank');
		$this->set('factionRanks', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FactionRank', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('factionRank', $this->FactionRank->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FactionRank->create();
			if ($this->FactionRank->save($this->data)) {
				$this->Session->setFlash(__('The FactionRank has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FactionRank could not be saved. Please, try again.', true));
			}
		}
		$factions = $this->FactionRank->Faction->find('list');
		$ranks = $this->FactionRank->Rank->find('list');
		$this->set(compact('factions', 'ranks'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FactionRank', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FactionRank->save($this->data)) {
				$this->Session->setFlash(__('The FactionRank has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FactionRank could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FactionRank->read(null, $id);
		}
		$factions = $this->FactionRank->Faction->find('list');
		$ranks = $this->FactionRank->Rank->find('list');
		$this->set(compact('factions','ranks'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FactionRank', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->FactionRank->del($id)) {
			$this->Session->setFlash(__('FactionRank deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The FactionRank could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
