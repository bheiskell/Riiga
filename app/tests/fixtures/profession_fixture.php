<?php 
/* SVN FILE: $Id$ */
/* Profession Fixture generated on: 2010-08-08 14:55:52 : 1281279352*/

class ProfessionFixture extends CakeTestFixture {
	var $name = 'Profession';
	var $table = 'professions';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession_category_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'profession_category_id' => 1
	));
}
?>