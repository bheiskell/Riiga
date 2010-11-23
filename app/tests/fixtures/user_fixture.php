<?php
class UserFixture extends CakeTestFixture {
  var $name = 'User';
  var $import = 'User';
  var $records = array(
    array(
      'id' => '1',
      'username' => 'test_account_1',
      'password' => 'BOGUS_DATA',
      'email' => 'test_account_1@example.com',
      'url' => 'http://www.example.com',
      'avatar' => 'http://www.example.com/avatar.jpg',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    array(
      'id' => '2',
      'username' => 'test_account_2',
      'password' => 'BOGUS_DATA',
      'email' => 'test_account_2@example.com',
      'url' => 'http://www.example.com',
      'avatar' => '',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    array(
      'id' => '3',
      'username' => 'test_account_3',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    array(
      'id' => '4',
      'username' => 'test_account_4',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
  );
}
?>
