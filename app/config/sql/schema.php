<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-03-15 21:03:20 : 1268704520*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $characters = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'history' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'rank' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'wallet' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'race' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'faction' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'residency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'profession' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 320),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'indexes' => array()
	);
}
?>
