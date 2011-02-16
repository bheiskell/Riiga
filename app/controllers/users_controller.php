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
    $user = $this->User->findBySlug($id);
    $characters = $this->User->Character->find('all', array(
      'conditions' => array('Character.user_id' => $user['User']['id']),
      'contain'    => array('Faction', 'Location', 'Race', 'Rank'),
    ));
    $stories = $this->User->Story->find('all_by_user_id', $user['User']['id']);

    $next_rank = $this->User->getEntriesUntilNextRank($user['User']['id']);
    $this->set(compact('user', 'characters', 'stories', 'next_rank'));

    if (empty($this->viewVars['user'])) {
      $this->cakeError('error404');
    }

    $this->pageTitle = 'Users - ' . $user['User']['username'];
  }

  function register() {
    if (!empty($this->data)) {
      $this->User->create();
      if ($this->User->save($this->data)) {
        $this->Auth->login($this->User->hashPasswords($this->data, false));
        $this->redirect(array(
          'controller' => 'pages',
          'action'     => 'registration_complete',
        ));
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
        $this->redirect(array('action' => 'view', $this->User->field('slug')));
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
    if (!empty($this->data)) {
      if ($this->Message->send(
        $this->data['Message']['recv_user_id'],
        $this->Auth->user('id'),
        $this->data['Message']['message'],
        $this->data['Message']['title']
      )) {
        $this->_email(
          $this->data['Message']['recv_user_id'],
          $this->data['Message']['message']
        );
        $this->flash('Message sent', '/');
      }
    }

    if (null !== $id) { $this->data['Message']['recv_user_id'] = $id; }
  }

  function view_message($message_id = null) {
    if (!empty($this->data)) {
      $message = $this->Message->markAsRead(
        $this->data['Message']['id'],
        $this->Auth->user('id')
      )
        ? 'Message marked as read'
        : 'Failed to mark message as read';
      $this->flash($message, array('action' => 'messages'));
    }

    $this->Message->contain('SendUser');

    $message = $this->Message->findById($message_id);

    if (empty($message)) { $this->cakeError('error404'); }

    if ($this->Auth->user('id') !== $message['Message']['recv_user_id']) {
      $this->flash('This message does not belong to you', array(
        'action' => 'messages',
      ));
    }

    $this->set(compact('message'));

    $this->data['Message']['id'] = $message_id;
  }

  function messages() {
    if (!empty($this->data)) {
      foreach ($this->data['Messages'] as $message) {
        $this->Message->markAsRead($message, $this->Auth->user('id'));
      }
    }
    $messages = $this->Message->find('unread', $this->Auth->user('id'));
    $this->set(compact('messages'));
  }
}
?>
