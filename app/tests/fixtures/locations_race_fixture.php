<?php 
/* SVN FILE: $Id$ */
/* LocationsRace Fixture generated on: 2010-08-08 00:04:31 : 1281225871*/

class LocationsRaceFixture extends CakeTestFixture {
	var $name = 'LocationsRace';
	var $table = 'locations_races';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'likelihood' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'location_id' => 1,
		'race_id' => 1,
		'likelihood' => 1
	));
}
?>