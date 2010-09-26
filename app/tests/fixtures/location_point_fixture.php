<?php 
/* SVN FILE: $Id$ */
/* LocationPoint Fixture generated on: 2010-09-26 22:09:16 : 1285538956*/

class LocationPointFixture extends CakeTestFixture {
	var $name = 'LocationPoint';
	var $table = 'location_points';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'x' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'y' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'location_id' => 1,
		'x' => 1,
		'y' => 1
	));
}
?>