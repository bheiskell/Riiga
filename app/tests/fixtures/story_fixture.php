<?php

class StoryFixture extends CakeTestFixture {
  var $name = 'Story';
  var $import = array('table' => 'stories', 'import' => false);
  var $records = array(
    array(
      'id'             => '1',
      'name'           => 'Lorel Ipsums\' Story',
      'slug'           => 'lorel_ipsums__story',
      'is_invite_only' => '0',
      'is_completed'   => '0',
      'is_deactivated' => '0',
      'location_id'    => '12',
      'user_id_turn'   => '0',
      'created'        => '2010-11-23 00:29:10',
      'modified'       => '2010-11-23 00:46:02',
    ),
  );
}

?>
