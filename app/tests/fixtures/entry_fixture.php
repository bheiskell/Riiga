<?php 
/* SVN FILE: $Id$ */
/* Entry Fixture generated on: 2010-03-28 14:00:03 : 1269799203*/

class EntryFixture extends CakeTestFixture {
	var $name = 'Entry';
	var $table = 'entries';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'content' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'is_dialog' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'is_deactivated' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'story_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'is_dialog' => 1,
		'is_deactivated' => 1,
		'story_id' => 1,
		'user_id' => 1
	));
}
?>