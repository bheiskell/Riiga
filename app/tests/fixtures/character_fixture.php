<?php 
/* SVN FILE: $Id$ */
/* Character Fixture generated on: 2010-03-15 21:03:16 : 1268701396*/

class CharacterFixture extends CakeTestFixture {
	var $name = 'Character';
	var $table = 'characters';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'rank' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'wallet' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'race' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'faction' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'residency' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'profession' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'avatar' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'member_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'rank' => 1,
		'wallet' => 1,
		'race' => 'Lorem ipsum dolor sit amet',
		'faction' => 'Lorem ipsum dolor sit amet',
		'residency' => 'Lorem ipsum dolor sit amet',
		'profession' => 'Lorem ipsum dolor sit amet',
		'avatar' => 'Lorem ipsum dolor sit amet',
		'member_id' => 1
	));
}
?>