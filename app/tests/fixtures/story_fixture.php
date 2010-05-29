<?php 
/* SVN FILE: $Id$ */
/* Story Fixture generated on: 2010-03-28 14:47:02 : 1269802022*/

class StoryFixture extends CakeTestFixture {
	var $name = 'Story';
	var $table = 'stories';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'is_invite_only' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'is_completed' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'location_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'user_id_turn' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'is_invite_only' => 1,
		'is_completed' => 1,
		'is_deactivated' => 1,
		'location_id' => 1,
		'user_id_turn' => 1
	));
}
?>