<?php

class ChatFixture extends CakeTestFixture {
  var $name = 'Chat';
  var $import = array('table' => 'chats', 'import' => false);
  var $records = array(
    array(
      'id'             => '1',
      'user_id'        => '1',
      'message'        => 'Welcome to Riiga!',
      'is_deactivated' => '0',
      'created'        => '2011-01-05 00:02:51',
      'modified'       => '2011-01-05 00:02:51',
    ),
  );
}

?>
