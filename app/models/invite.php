<?php
class Invite extends AppModel {

  var $name = 'Invite';
  var $validate = array(
    'id' => array('numeric'),
    'story_id' => array(
      'required' => true,
      'allowEmpty' => false,
      'rule' => array('numeric')
    ),
    'user_id' => array('numeric'),
    'created' => array('date'),
    'modified' => array('date')
  );

  var $belongsTo = array('Story', 'User');

}
?>
