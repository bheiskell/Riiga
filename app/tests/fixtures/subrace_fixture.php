<?php 
/* SVN FILE: $Id$ */
/* Subrace Fixture generated on: 2011-01-07 23:34:04 : 1294443244*/

class SubraceFixture extends CakeTestFixture {
	var $name = 'Subrace';
	var $table = 'subraces';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'race_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'location_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'race_id' => 1,
		'location_id' => 1
	));
}
?>