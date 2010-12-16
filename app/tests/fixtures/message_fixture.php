<?php 
/* SVN FILE: $Id$ */
/* Message Fixture generated on: 2010-12-16 19:27:22 : 1292527642*/

class MessageFixture extends CakeTestFixture {
	var $name = 'Message';
	var $table = 'messages';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'recv_user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'send_user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'message' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'is_read' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'recv_user_id' => 1,
		'send_user_id' => 1,
		'message' => 'Lorem ipsum dolor sit amet',
		'is_read' => 1,
		'created' => '2010-12-16 19:27:22',
		'modified' => '2010-12-16 19:27:22'
	));
}
?>