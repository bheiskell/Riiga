<?php

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $records = array(
		array(
			'id' => '1',
			'username' => 'etherealpanda',
			'password' => '244bc28b8a354fbb07bcede5d3a9e686f19d41d6',
			'email' => 'etherealpanda.mail@gmail.com',
			'url' => 'http://www.etherealpanda.com',
			'avatar' => '',
			'created' => '2010-06-16 19:56:07',
			'modified' => '2010-10-03 21:44:23',
		),
		array(
			'id' => '2',
			'username' => 'Treijim',
			'password' => '7915b468925d1cbd2e21a2f741603dd90877ba34',
			'email' => 'treijim@gmail.com',
			'url' => '',
			'avatar' => '',
			'created' => '2010-06-16 21:49:58',
			'modified' => '2010-06-16 21:49:58',
		),
	);
}

?>
