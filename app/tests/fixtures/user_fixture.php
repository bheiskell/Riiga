<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2010-03-15 21:04:04 : 1268701444*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'password' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 320),
		'avatar' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'username' => 'Lorem ipsum dolor sit amet',
		'password' => 'Lorem ipsum dolor sit amet',
		'email' => 'Lorem ipsum dolor sit amet',
		'avatar' => 'Lorem ipsum dolor sit amet'
	));
}
?>