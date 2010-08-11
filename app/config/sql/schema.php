<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-08-06 01:08:01 : 1281059101*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $character_locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $characters = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'history' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'faction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'age' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'is_npc' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $characters_entries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'character_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'entry_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $characters_stories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'character_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $entries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'content' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'is_dialog' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $location_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $location_tags_locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'location_tag_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $ranks = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'entry_count' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $stories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'is_invite_only' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_completed' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'user_id_turn' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $stories_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'is_manager' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 320),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
}
?>
