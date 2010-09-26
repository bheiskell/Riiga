<?php 
/* SVN FILE: $Id$ */
/* LocationRegion Fixture generated on: 2010-09-26 22:09:46 : 1285538986*/

class LocationRegionFixture extends CakeTestFixture {
	var $name = 'LocationRegion';
	var $table = 'location_regions';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'left' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'top' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'width' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'height' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'location_id' => 1,
		'left' => 1,
		'top' => 1,
		'width' => 1,
		'height' => 1
	));
}
?>