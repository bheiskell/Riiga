<?php 
/* SVN FILE: $Id$ */
/* ProfessionsRace Fixture generated on: 2010-08-08 14:57:01 : 1281279421*/

class ProfessionsRaceFixture extends CakeTestFixture {
	var $name = 'ProfessionsRace';
	var $table = 'professions_races';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'profession_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'age' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'profession_id' => 1,
		'race_id' => 1,
		'age' => 1
	));
}
?>