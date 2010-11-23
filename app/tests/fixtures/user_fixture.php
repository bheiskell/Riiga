<?php
class UserFixture extends CakeTestFixture {
  var $name = 'User';
  var $import = 'User';
  var $records = array(
    /**
     * Owns one character who has been in two stories and is active in one.
     */
    array(
      'id' => '1',
      'username' => 'test_account_1',
      'password' => 'BOGUS_DATA',
      'email' => 'test_account_1@example.com',
      'url' => 'http://www.example.com',
      'avatar' => 'http://www.example.com/avatar.jpg',
      'is_admin' => '0',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    /**
     * Owns one character who has entered and left a story.
     */
    array(
      'id' => '2',
      'username' => 'test_account_2',
      'password' => 'BOGUS_DATA',
      'email' => 'test_account_2@example.com',
      'url' => 'http://www.example.com',
      'avatar' => '',
      'is_admin' => '0',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    /**
     * Owns one character who has entered a story.
     */
    array(
      'id' => '3',
      'username' => 'test_account_3',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'is_admin' => '0',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    /**
     * Owns one character who has done nothing.
     */
    array(
      'id' => '4',
      'username' => 'test_account_4',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'is_admin' => '0',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    /**
     * Owns no characters. Is an admin.
     */
    array(
      'id' => '5',
      'username' => 'test_account_5',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'is_admin' => '1',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
    /**
     * Owns no characters. TODO Has a entry offset of 100.
     */
    array(
      'id' => '6',
      'username' => 'test_account_6',
      'password' => 'BOGUS_DATA',
      'email' => '',
      'url' => '',
      'avatar' => '',
      'is_admin' => '1',
      'created' => '2010-06-16 19:56:07',
      'modified' => '2010-10-03 21:44:23',
    ),
  );
}
?>
