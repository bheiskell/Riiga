<?php
class AppController extends Controller {
  var $view       = 'App'; 
  var $components = array(
    'RequestHandler',
    'SecurityExtended',
    'Auth',
    'Session',
    'Email',
  );
  var $uses       = array('Chat', 'Message');
  var $helpers    = array(
    'Form',
    'Html',
    'Javascript',
    'Rss',
    'Altrow',
    'Avatar',
    'Minimap',
    'Stars',
    'Asset.asset' => array(
      //'debug'       => -1, // Activates helper in development
      'checkTs'     => true,
      'md5FileName' => true,
      'fixCssImg'   => true,
    ),
  );

  /**
   * beforeFilter
   *
   * Open access to display action.
   * Set a few view variables.
   * Get chats and unread message counts.
   * Check authorization for prefix routes.
   *
   * @access public
   * @return void
   */
  public function beforeFilter() {
    $this->SecurityExtended->blackHoleCallback = '_blackhole';

    $this->Auth->allow('display'); // for the pages controller

    $userId      = $this->Auth->user('id');
    $isAdmin     = $this->_isAdmin();
    $isModerator = $this->_isModerator();

    $chats        = $this->Chat->find('last_25');
    $messageCount = $this->Message->find('count_unread', $userId);

    $this->set(compact(
      'userId',
      'isAdmin',
      'isModerator',
      'chats',
      'messageCount'
    ));

    if (  ($this->_getParam('admin')     || $this->_getParam('moderator'))
      && !($this->_getParam('admin')     && $isAdmin)
      && !($this->_getParam('moderator') && $isModerator)
    ) {
      $this->cakeError('error403');
    }
  }

  public function _blackhole($error) {
    $this->cakeError('error500', array('message' => 'blackhole: ' . $error));
  }

  /**
   * _isOwner
   *
   * Central location to check if the currently authenticated user is allowed
   * to modify resources created by a particular owner.
   *
   * Currently, being an admin does not qualify you as an owner.
   *
   * @param int $user_id User id that owns a given resource.
   * @access protected
   * @return boolean True if allowed
   */
  protected function _isOwner($user_id) {
    return $user_id == $this->Auth->user('id');
  }

  /**
   * _isModerator
   *
   * Check if the currently authenticated user is allowed to moderate the loaded
   * resources. This check will have to be performed in each of the controllers
   * that allow moderation. Hence why this always returns false.
   *
   * @access protected
   * @return boolean True if the user is a moderator
   */
  protected function _isModerator() {
    return false;
  }

  /**
   * _isAdmin
   *
   * Wrapper for auth cache check. Creating this to stay consistent with
   * _isModerator and _isOwner convention.
   *
   * @access protected
   * @return boolean True if user is an admin
   */
  protected function _isAdmin() {
    return $this->Auth->user('is_admin');
  }

  /**
   * _getParam
   *
   * $this->param accessor that automattically performs the isset check and
   * can default to a specified value
   *
   * @param mixed $first First key of the $this->params
   * @param mixed $second Optional second key of $this->params
   * @param mixed $default Default value of null
   * @access protected
   * @return mixed Value of the param
   */
  protected function _getParam($first, $second = null, $default = null) {
    $result = isset($this->params[$first]) ? $this->params[$first] : $default;

    if (null == $second) { return $result; }

    return isset($result[$second]) ? $result[$second] : $default;
  }

  /**
   * flash
   *
   * The typical Session based setFlash method is far to verbose for my use
   * cases. Overloading the non-session based flash to accomplish a more
   * concise result.
   *
   * @param mixed $message
   * @param mixed $url Url to redirect to, defaults to action => index
   * @param mixed $pause Unused
   * @access public
   * @return void Ends execution
   */
  public function flash($message, $url = false, $pause = false) {
    if (false == $url) {
      $url = array('action' => 'index');
    }
    $this->Session->setFlash(__($message, true));
    $this->redirect($url);
  }

  /**
   * _sendMessage
   *
   * Send a user a message from the currently logged in user.
   *
   * @param mixed $user_id
   * @param mixed $message
   * @param mixed $brief Actually the title, but renamed because thats a
   *                     reserved variable
   * @access public
   * @return void
   */
  public function _sendMessage($recv_id, $message, $brief = false) {
    $send_id = $this->Auth->user('id');

    $this->loadModel('User', $recv_id);

    $recv = $this->User->findById($recv_id);
    $send = $this->Auth->user();

    if (empty($send) || empty($recv)) { return false; }

    $brief = ($brief) ? $brief : substr($message, 0, 252) . '...';

    $result = $this->Message->send($recv_id, $send_id, $message, $brief);

    $message_id = $this->Message->id;

    $verification = $this->_getUserVerification($recv);

    if ($recv['User']['receive_email'] && !empty($recv['User']['email'])) {
      if (0 < Configure::read()) {
        $this->Email->delivery = 'debug';
      }
      $this->Email->to = $recv['User']['email'];
      $this->Email->subject = 'You have received a new message!';
      $this->Email->from = 'Riiga Message Notifier<no-reply@etherealpanda.com>';
      $this->Email->template = 'message';
      $this->Email->sendAs = 'text';

      $this->set(compact(
        'recv', 'send', 'message_id', 'message', 'brief', 'verification'
      ));
      $this->Email->send();
    }

    return $result;
  }

  /**
   * _generateUnsubscribe
   *
   * Get a verification hash for a user. This should be used for the unsubscribe
   * link and unsubscribe link alone.
   *
   * @param mixed $user
   * @access public
   * @return void
   */
  public function _getUserVerification($user) {
    $hash = $user['User']['username'] . $user['User']['password'];
    for ($i = 0; $i < 999; $i++) {
      $hash = Security::hash($hash, false, true);
    }
    return $hash;
  }
}
