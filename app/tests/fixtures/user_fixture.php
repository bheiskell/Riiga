<?php

class UserFixture extends CakeTestFixture {
  var $name = 'User';
  var $import = array('table' => 'users', 'import' => false);
  var $records = array(
    array(
      'id'             => '1',
      'username'       => 'Lorem Ipsum',
      'slug'           => 'lorem_ipsum',
      'password'       => '767d554e12f27402f81df8317a8b18d42fd045c6',
      'email'          => 'lorem_ipsum_test_email@gmail.com',
      'receive_email'  => '1',
      'url'            => 'http://www.riiga.net',
      'avatar'         => '',
      'is_admin'       => '0',
      'is_deactivated' => '0',
      'offset'         => '0',
      'created'        => '2007-08-02 00:00:00',
      'modified'       => '2011-02-16 02:19:29',
    ),
    array(
      'id'             => '2',
      'username'       => 'Lorem Ipsum Brother',
      'slug'           => 'lorem_ipsum_brother',
      'password'       => '767d554e12f27402f81df8317a8b18d42fd045c6',
      'email'          => 'lorem_ipsum_test_email_2@gmail.com',
      'receive_email'  => '0',
      'url'            => '',
      'avatar'         => 'http://riiga.net/img/avatar/lorem.jpg',
      'is_admin'       => '0',
      'is_deactivated' => '0',
      'offset'         => '0',
      'created'        => '2007-08-02 00:00:00',
      'modified'       => '2011-02-16 02:19:29',
    ),
  );
}

?>
