<?php
class Message extends AppModel {
  var $name = 'Message';

  var $belongsTo = array(
    'RecvUser' => array('className' => 'User', 'foreignKey' => 'recv_user_id'),
    'SendUser' => array('className' => 'User', 'foreignKey' => 'send_user_id')
  );

  var $validate = array(
    'id' => array('numeric'),
    'recv_user_id' => array('numeric'),
    'send_user_id' => array('numeric'),
    'message' => array('between', 1, 10240),
    'title' => array('maxlength', 256),
    'is_read' => array('range', 0, 1),
    'is_deactivated' => array('range', 0, 1),
    'created' => array('date'),
    'modified' => array('date')
  );

  function sendMessage($recv_user_id, $send_user_id, $message, $title) {
    $this->create();
    $this->set(compact(
      'recv_user_id',
      'from_user_id',
      'title',
      'message'
    ));
    return $this->save();
  }

  function markAsRead($id) {
    $this->id = $id;
    return $this->saveField('is_read', true);
  }

  function __findCountUnread($user_id) {
    return $this->find('count', array(
      'conditions' => array(
        'recv_user_id' => $user_id,
        'is_read' => false,
      ),
    ));
  }

  function getPaginateParams() {
    return array(
      'conditions' => array('user_id' => $user_id),
      'order' => 'Message.created DESC',
    );
  }
}
?>
