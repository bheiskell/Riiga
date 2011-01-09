<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2011-01-07 22:01:50 : 1294440050*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $character_locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $characters = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'history' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'faction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'faction_rank_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'age' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'is_npc' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'subrace_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'user_comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'admin_comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $characters_entries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'character_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'entry_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $characters_stories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'character_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'is_deactivated' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $chats = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'message' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $entries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'content' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'is_dialog' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $faction_ranks = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'faction_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'age' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $factions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $factions_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'faction_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $invites = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $location_points = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'x' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'y' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $location_regions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'left' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'top' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'width' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'height' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $location_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $location_tags_locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'location_tag_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $locations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $locations_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'likelihood' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $messages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'recv_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'send_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'message' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'is_read' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pending_characters = array(
		'pending_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'history' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'subrace_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'faction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'faction_rank_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'age' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'is_npc' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'user_comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'admin_comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'pending_id', 'unique' => 1))
	);
	var $profession_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $professions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession_category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $professions_races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'profession_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'age' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $race_ages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'child' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'teen' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'adult' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'mature' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'elder' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'max' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $races = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'rank_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $ranks = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'entry_count' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $stories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'is_invite_only' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_completed' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id_turn' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $stories_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'story_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'is_moderator' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $subraces = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'race_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 320),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'is_admin' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'offset' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'is_deactivated' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>
