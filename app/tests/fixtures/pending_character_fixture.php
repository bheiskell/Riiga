<?php 
/* SVN FILE: $Id$ */
/* PendingCharacter Fixture generated on: 2010-10-30 19:03:49 : 1288465429*/

class PendingCharacterFixture extends CakeTestFixture {
	var $name = 'PendingCharacter';
	var $table = 'pending_characters';
	var $fields = array(
		'pending_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'history' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'rank_id' => array('type'=>'integer', 'null' => true, 'default' => '1'),
		'location_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'race_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'faction_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'age' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'profession' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'avatar' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'is_npc' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'pending_id' => 1,
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'history' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'rank_id' => 1,
		'location_id' => 1,
		'race_id' => 1,
		'faction_id' => 1,
		'age' => 'Lorem ipsum dolor sit amet',
		'profession' => 'Lorem ipsum dolor sit amet',
		'avatar' => 'Lorem ipsum dolor sit amet',
		'is_npc' => 1,
		'is_deactivated' => 1,
		'user_id' => 1,
		'created' => '2010-10-30 19:03:49',
		'modified' => '2010-10-30 19:03:49'
	));
}
?>