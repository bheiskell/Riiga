<?php

class MessageFixture extends CakeTestFixture {
  var $name = 'Message';
  var $import = array('table' => 'messages', 'import' => false);
  var $records = array(
    array(
      'id'             => '1',
      'recv_user_id'   => '94',
      'send_user_id'   => '3',
      'message'        => 'This is my message.',
      'title'          => 'This is my title!',
      'is_read'        => '0',
      'is_deactivated' => '0',
      'created'        => '2011-02-12 10:21:26',
      'modified'       => '2011-02-12 10:21:26',
    ),
  );
}

?>
