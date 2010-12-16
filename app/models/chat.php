<?php
class Chat extends AppModel {

	var $name = 'Chat';
	var $useDbConfig = 'development';
	var $validate = array(
		'id' => array('numeric'),
		'user_id' => array('numeric'),
		'message' => array('maxlength'),
		'title' => array('maxlength'),
		'is_read' => array('inlist'),
		'created' => array('date'),
		'modified' => array('date')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>