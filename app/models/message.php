<?php
class Message extends AppModel {
  var $name = 'Message';

  var $belongsTo = array(
    'RecvUser' => array(
      'className' => 'User',
      'foreignKey' => 'recv_user_id'
    ),
    'SendUser' => array(
      'className' => 'User',
      'foreignKey' => 'send_user_id'
    ),
  );

  var $validate = array(
    'id' => array('numeric'),
    'recv_user_id' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => array('numeric'),
    ),
    'send_user_id' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => array('numeric')
    ),
    'message' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => array('between', 1, 10240)
    ),
    'title' => array(
      'required' => true,
      'allowEmpty' => true,
      'rule' => array('maxlength', 256)
    ),
    'is_read' => array(
      'required' => false,
      'allowEmpty' => true,
      'rule' => array('inList', array(0, 1))
    ),
    'is_deactivated' => array(
      'required' => false,
      'allowEmpty' => true,
      'rule' => array('inList',  array(0, 1))
    ),
    'created' => array('date'),
    'modified' => array('date')
  );

  /**
   * send
   *
   * Send a message.
   *
   * @param mixed $recv_user_id
   * @param mixed $send_user_id
   * @param mixed $message
   * @param mixed $title
   * @access public
   * @return boolean
   */
  public function send($recv_user_id, $send_user_id, $message, $title) {
    $this->create();
    $this->set(compact(
      'recv_user_id',
      'send_user_id',
      'title',
      'message'
    ));
    return $this->save();
  }

  /**
   * sendToAdmins
   *
   * Send admins a message.
   *
   * @param mixed $send_user_id
   * @param mixed $message
   * @param mixed $title
   * @access public
   * @return boolean
   */
  public function sendToAdmins($send_user_id, $message, $title) {
    $admins    = $this->RecvUser->findAllByIsAdmin(true);
    $admin_ids = Set::extract('/RecvUser/id', $admins);

    $result = true;
    foreach ($admin_ids as $id) {
      $result &= $this->send(
        $id,
        $send_user_id,
        $message,
        $title
      );
    }
    return $result;
  }

  /**
   * markAsRead
   *
   * Mark a message for a user as read. ACLs are checked here.
   *
   * @param mixed $id
   * @param mixed $user_id
   * @access public
   * @return boolean
   */
  public function markAsRead($id, $user_id) {
    $this->id = $id;
    if ($user_id !== $this->field('recv_user_id')) { return false; }
    return $this->saveField('is_read', true);
  }

  /**
   * __findCountUnread
   *
   * Find the number of unread messages for a user
   *
   * @param int $user_id
   * @access protected
   * @return int
   */
  protected function __findCountUnread($user_id) {
    return $this->find('count', array(
      'conditions' => array(
        'recv_user_id' => $user_id,
        'is_read' => false,
      ),
    ));
  }

  /**
   * __findUnread
   *
   * Find unread messages for auser
   *
   * @param int $user_id
   * @access protected
   * @return mixed
   */
  protected function __findUnread($user_id) {
    $this->contain('SendUser');
    return $this->find('all', array(
      'conditions' => array(
        'recv_user_id' => $user_id,
        'is_read' => false,
      ),
    ));
  }

  /**
   * getPaginateParams
   *
   * Get the params for the paginator
   *
   * @access public
   * @return void
   */
  public function getPaginateParams() {
    return array(
      'conditions' => array('user_id' => $user_id),
      'order' => 'Message.created DESC',
    );
  }

  /**
   * afterFind
   *
   * When the title isn't set, we want to limit the title to the first few
   * characters of the message
   *
   * @param mixed $results
   * @param mixed $primary
   * @access public
   * @return mixed Modified results
   */
  public function afterFind($results, $primary) {
    if ($primary && Set::numeric(array_keys($results))) {
      foreach ($results as &$result) {
        if (  isset($result['Message'])
          && !empty($result['Message']['message'])
          &&  empty($result['Message']['title'])
        ) {
          $result['Message']['title'] = substr(
            $result['Message']['message'],
            0,
            $this->_schema['title']['length']
          );
        }
      }
    }
    return $results;
  }
}
?>
