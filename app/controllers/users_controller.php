<?php
class UsersController extends AppController {

  var $name = 'Users';
  var $helpers = array('Html', 'Form');
  var $paginate = array('order' => array('User.id' => 'desc'));

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'register');

    $this->Auth->loginRedirect = array(
      'controller' => 'index',
      'action'     => 'index'
    );

    /**
     * Override hashPassword method for validation purposes. See
     * User->hashPasswords for more information.
     */
    if ($this->action == 'register' || $this->action == 'edit') {
      $this->Auth->authenticate = $this->User;
    }
  }

  function register() {
    if (!empty($this->data)) {
      $this->User->create();
      if ($this->User->save($this->data)) {
        $this->Auth->login($this->User->hashPasswords($this->data, false));
        $this->Session->setFlash(__('Registration Successful', true));
        $this->redirect($this->Auth->redirect());
      }
    }
    /* Unset sensitive fields */
    unset($this->data['password']);
    unset($this->data['password_confirm']);
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
    $this->set('characters', $this->User->Character->find(
      'all', array('conditions' => array('Character.user_id' => $id)))
    );
  }

  function edit() {
    $id = $this->Auth->user('id');
    if (!empty($this->data)) {
      $this->data['User']['id'] = $id;

      if ($this->User->save($this->data)) {
        $this->Session->setFlash(__('Your account has been updated.', true));
        $this->redirect(array('action' => 'view', $id));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->User->read(null, $id);
    }

    /**
     * Unset sensitive fields. If coming from the database, the passwords will
     * be hashed anyways.
     */
    unset($this->data['User']['password']);
    unset($this->data['User']['password_confirm']);
  }
}
?>
