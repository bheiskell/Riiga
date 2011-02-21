<?php
class ChatsController extends AppController {

  function beforeFilter() {
    $this->Auth->allow('index', 'rss');
  }

  function post() {
    if (!empty($this->data) && $this->Auth->user('id')) {
      $message = (
        $this->Chat->post(
          $this->Auth->user('id'),
          $this->data['Chat']['message']
        )
      ) ? 'Message posted' : array_shift($this->Chat->validationErrors);

    } else {
      $message = 'Failed to post message';
    }
    $this->flash($message, '/');
  }

  function index() {
    $this->paginate['Chat'] = array('order' => 'Chat.created DESC');

    $this->posts = $this->paginate();

    $this->set(compact('chats'));
  }

  function rss() {
    $chats = $this->Chat->find('all', array(
      'contain' => array('User'),
      'order'   => 'Chat.created DESC',
      'limit'   => 20,
    ));
    $this->set(compact('chats'));
  }
}
