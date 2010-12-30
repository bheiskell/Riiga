<?php 
/* SVN FILE: $Id$ */
/* Invite Fixture generated on: 2010-12-27 15:55:31 : 1293465331*/

class InviteFixture extends CakeTestFixture {
	var $name = 'Invite';
	var $table = 'invites';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'story_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'story_id' => 1,
		'user_id' => 1,
		'created' => '2010-12-27 15:55:31',
		'modified' => '2010-12-27 15:55:31'
	));
}
?>