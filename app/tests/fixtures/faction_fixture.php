<?php 
/* SVN FILE: $Id$ */
/* Faction Fixture generated on: 2010-08-08 12:20:44 : 1281270044*/

class FactionFixture extends CakeTestFixture {
	var $name = 'Faction';
	var $table = 'factions';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet'
	));
}
?>