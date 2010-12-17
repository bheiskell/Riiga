<?php
class Chat extends AppModel {
  var $name = 'Chat';

  var $validate = array(
    'id' => array('numeric'),
    'user_id' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => 'numeric',
    ),
    'message' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => array('between', 1, 256),
      'message' => 'Chat messages must be between 1 and 256 characters.',
    ),
    'is_read' => array(
      'required' => false,
      'allowEmpty' => true,
      'rule' => array('inList', array(0, 1))
    ),
    'is_deactivated' => array(
      'required' => false,
      'allowEmpty' => true,
      'rule' => array('inList', array(0, 1))
    ),
    'created' => array('date'),
    'modified' => array('date')
  );

  var $belongsTo = array('User');

  function post($user_id, $message) {
    $this->create();
    $this->set(compact(
      'user_id',
      'message'
    ));
    return $this->save();
  }

  function __findLast25() {
    return array_reverse($this->find('all', array(
      'limit' => 25,
      'order' => array('Chat.created DESC'),
      'contain' => array('User'),
    )));
  }
}
?>
