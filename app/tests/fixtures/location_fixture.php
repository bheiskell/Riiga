<?php 
/* SVN FILE: $Id$ */
/* Location Fixture generated on: 2010-06-16 19:54:41 : 1276718081*/

class LocationFixture extends CakeTestFixture {
	var $name = 'Location';
	var $table = 'locations';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'parent_id' => 1,
		'created' => '2010-06-16 19:54:41',
		'modified' => '2010-06-16 19:54:41'
	));
}
?>