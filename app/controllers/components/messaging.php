<?php
/**
 * MessageComponent
 *
 * Riiga specific component that sends messages / emails
 *
 * @uses Object
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class MessagingComponent extends Object {

  var $components = array('Email', 'Auth', 'Security');

  function startup(&$controller) {
    $this->controller =& $controller;
  }

  /**
   * send
   *
   * Send a message to a user and the corrosponding email if the user has email
   * enabled.
   *
   * @param mixed $user_id 
   * @param mixed $message 
   * @param mixed $message_title 
   * @access public
   * @return void
   */
  public function send($user_id, $message, $message_title = '') {
    $this->controller->loadModel('User');
    $this->controller->loadModel('Message');

    $recv = $this->controller->User->findById($user_id);
    $send = $this->Auth->user();

    if (empty($send) || empty($recv)) { return false; }

    if ('' == $message_title) {
      $message_title = substr($message, 0, 225) . '...';
    }

    $result = $this->controller->Message->send($user_id, $send['User']['id'], $message, $message_title);
    $message_id = $this->controller->Message->id;

    $verification = $this->getUserVerification($recv);

    if ($recv['User']['receive_email'] && !empty($recv['User']['email'])) {
      if (0 < Configure::read()) {
        $this->Email->delivery = 'debug';
      }
      $this->Email->to       = $recv['User']['email'];
      $this->Email->from     = 'Riiga Message Notifier'
                             . '<no-reply@etherealpanda.com>';
      $this->Email->subject  = 'You have received a new message!';
      $this->Email->template = 'message';
      $this->Email->sendAs   = 'both';

      $this->controller->set(compact(
        'recv', 'send', 'message_id', 'message', 'message_title', 'verification'
      ));

      $this->Email->send();
    }

    return $result;
  }

  /**
   * generateUnsubscribe
   *
   * Get a verification hash for a user. This should be used for the unsubscribe
   * link and unsubscribe link alone.
   *
   * @param mixed $user
   * @access public
   * @return void
   */
  public function getUserVerification($user) {
    $hash = $user['User']['username'] . $user['User']['password'];
    for ($i = 0; $i < 999; $i++) {
      $hash = Security::hash($hash, false, true);
    }
    return $hash;
  }
}
