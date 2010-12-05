<?php 
/* SVN FILE: $Id$ */
/* StoriesUser Fixture generated on: 2010-11-29 00:54:38 : 1290992078*/

class StoriesUserFixture extends CakeTestFixture {
	var $name = 'StoriesUser';
	var $table = 'stories_users';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'story_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'is_moderator' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'story_id' => 1,
		'user_id' => 1,
		'is_moderator' => 1,
		'is_deactivated' => 1
	));
}
?>