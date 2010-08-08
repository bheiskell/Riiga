<?php 
/* SVN FILE: $Id$ */
/* ProfessionCategory Fixture generated on: 2010-08-08 14:56:27 : 1281279387*/

class ProfessionCategoryFixture extends CakeTestFixture {
	var $name = 'ProfessionCategory';
	var $table = 'profession_categories';
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