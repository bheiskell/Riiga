<?php
class UsersController extends AppController {

  var $name = 'Users';

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'register', 'index', 'view');

    $this->Auth->loginRedirect = array('/');

    /**
     * Override hashPassword method for validation purposes. See
     * User->hashPasswords for more information.
     */
    if ($this->action == 'register' || $this->action == 'edit') {
      $this->Auth->authenticate = $this->User;
    }
  }

  /* Automagically handled by the Auth component */
  function login() { }

  function admin_login() {
    $this->redirect(array(
      'controller' => 'users',
      'action' => 'login',
      'admin' => false
    ));
  }

  function logout() { $this->redirect($this->Auth->logout()); }

  function index() {
    $this->paginate['order'] = array('User.created' => 'DESC');
    $this->set('users', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Member', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->User->contain(array(
      'Character'
    ));
    $this->set('user', $this->User->findById($id));
    $this->set('characters',
      $this->User->Character->find('all', array(
        'conditions' => array('Character.user_id' => $id),
        'contain' => array('Faction', 'Location', 'Race', 'Rank'),
      ))
    );
    $this->set('stories', $this->User->Character->Story->findAllByUserId($id));

    if (empty($this->viewVars['user'])) {
      $this->cakeError('error404');
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
    $this->render('form');
  }

  function edit($id = null) {
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
    $this->render('form');
  }

  function message($id = null) {
    $this->Message->send(
      $id,
      $this->Auth->user('id'),
      'Hi this is a test message',
      'Blahbah'
    );
  }

  function messages() {
    $messages = $this->Message->find('unread', $this->Auth->user('id'));
    $this->set(compact('messages'));
  }
}
?>
