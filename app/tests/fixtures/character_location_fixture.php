<?php 
/* SVN FILE: $Id$ */
/* CharacterLocation Fixture generated on: 2010-08-06 01:35:43 : 1281058543*/

class CharacterLocationFixture extends CakeTestFixture {
	var $name = 'CharacterLocation';
	var $table = 'character_locations';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'rank_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'location_id' => 1,
		'rank_id' => 1
	));
}
?>