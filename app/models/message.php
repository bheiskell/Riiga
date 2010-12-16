<?php
class Message extends AppModel {

	var $name = 'Message';
	var $useDbConfig = 'development';
	var $validate = array(
		'id' => array('numeric'),
		'recv_user_id' => array('numeric'),
		'send_user_id' => array('numeric'),
		'message' => array('between'),
		'is_read' => array('inlist'),
		'created' => array('date'),
		'modified' => array('date')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'RecvUser' => array(
			'className' => 'User',
			'foreignKey' => 'recv_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SendUser' => array(
			'className' => 'User',
			'foreignKey' => 'send_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>