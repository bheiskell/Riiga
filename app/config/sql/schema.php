<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-10-30 20:10:55 : 1288472275*/
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
	var $faction_ranks = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'faction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'age' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $factions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $factions_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'faction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $location_points = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'x' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'y' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $location_regions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'left' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'top' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'width' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'height' => array('type' => 'integer', 'null' => false, 'default' => NULL),
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
	var $locations_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'likelihood' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $pending_characters = array(
		'pending_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'primary'),
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
	var $profession_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'indexes' => array()
	);
	var $professions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession_category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $professions_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'profession_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'age' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $race_ages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'race_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'child' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'teen' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'adult' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'mature' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'elder' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'max' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
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
		'is_admin' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
}
?>