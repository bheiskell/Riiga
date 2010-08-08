<?php 
/* SVN FILE: $Id$ */
/* FactionRank Fixture generated on: 2010-08-08 12:25:46 : 1281270346*/

class FactionRankFixture extends CakeTestFixture {
	var $name = 'FactionRank';
	var $table = 'faction_ranks';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'faction_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'rank_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'age' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'faction_id' => 1,
		'rank_id' => 1,
		'age' => 1
	));
}
?>