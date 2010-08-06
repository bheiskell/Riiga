<?php 
/* SVN FILE: $Id$ */
/* Rank Fixture generated on: 2010-08-06 01:32:57 : 1281058377*/

class RankFixture extends CakeTestFixture {
	var $name = 'Rank';
	var $table = 'ranks';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'entry_count' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'entry_count' => 1
	));
}
?>