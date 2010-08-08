<?php 
/* SVN FILE: $Id$ */
/* RaceAge Fixture generated on: 2010-08-08 12:03:33 : 1281269013*/

class RaceAgeFixture extends CakeTestFixture {
	var $name = 'RaceAge';
	var $table = 'race_ages';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'race_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'child' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'teen' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'adult' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'mature' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'elder' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'max' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'race_id' => 1,
		'child' => 1,
		'teen' => 1,
		'adult' => 1,
		'mature' => 1,
		'elder' => 1,
		'max' => 1
	));
}
?>