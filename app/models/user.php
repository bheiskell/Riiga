<?php
class User extends AppModel {
  var $displayField = 'username';

	var $name = 'User';
	var $validate = array(
		'username' => array(
      'maxlength' => array(
        'required' => true, 
        'allowEmpty' => false,
        'rule' => array('maxlength', 64)
      ),
      'isUnique' => array(
        'rule' => 'isUnique'
      )
    ),
		'password' => array('required' => true, 'allowEmpty' => false, 'rule' => array('between', 0, 40)),
		'password_confirm' => array('required' => true, 'allowEmpty' => false, 'rule' => array('between', 0, 40)),
		'email'    => array('required' => false, 'allowEmpty' => true, 'rule' => array('maxlength', 320)),
		'avatar'   => array(
      'maxlength' => array('rule' => array('maxlength', 1024)),
      'url'       => array('allowEmpty' => true, 'rule' => 'url')
    )
	);

  var $hasMany = array('Character');

  function beforeSave() {
    if (empty($this->data['User']['avatar'])) {
      $this->data['User']['avatar'] = 'avatar/default/member.png';
    }
    return true;
  }
}
?>
