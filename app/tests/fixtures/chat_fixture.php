<?php 
/* SVN FILE: $Id$ */
/* Chat Fixture generated on: 2010-12-16 19:28:36 : 1292527716*/

class ChatFixture extends CakeTestFixture {
	var $name = 'Chat';
	var $table = 'chats';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'message' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'title' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'is_read' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'user_id' => 1,
		'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'title' => 'Lorem ipsum dolor sit amet',
		'is_read' => 1,
		'created' => '2010-12-16 19:28:36',
		'modified' => '2010-12-16 19:28:36'
	));
}
?>