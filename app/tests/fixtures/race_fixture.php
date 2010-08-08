<?php 
/* SVN FILE: $Id$ */
/* Race Fixture generated on: 2010-08-07 22:28:16 : 1281220096*/

class RaceFixture extends CakeTestFixture {
	var $name = 'Race';
	var $table = 'races';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'rank_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'rank_id' => 1
	));
}
?>