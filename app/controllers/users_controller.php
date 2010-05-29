<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'register');
    $this->Auth->loginRedirect = array('controller' => 'index', 'action' => 'index');
  }

  function register() {
    if (!empty($this->data)) {
      $this->data['User']['password_confirm'] = $this->Auth->password($this->data['User']['password_confirm']);
      $this->User->create();
      if ($this->User->save($this->data)) {
        $this->Auth->login($this->data);
        $this->flash(__('User Registered', true), array('action' => 'index'));
        $this->redirect($this->Auth->redirect());
      }
    }
  }

  /* Automagically handled by the Auth component */
  function login() { }

  function logout() { $this->redirect($this->Auth->logout()); }

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
      //$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
      //$this->data['User']['password_confirm'] = $this->Auth->password($this->data['User']['password_confirm']);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The User could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>