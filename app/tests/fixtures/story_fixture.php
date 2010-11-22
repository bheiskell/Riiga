<?php
class StoryFixture extends CakeTestFixture {
  var $name = 'Story';
  var $import = 'Story';
  var $records = array(
    array(
      'id' => '1',
      'name' => 'Story Number 1',
      'is_invite_only' => '0',
      'is_completed' => '0',
      'is_deactivated' => '0',
      'location_id' => '',
      'user_id_turn' => '1',
      'created' => '2010-06-16 19:56:52',
      'modified' => '2010-06-16 19:56:52',
    ),
    array(
      'id' => '2',
      'name' => 'Completed',
      'is_invite_only' => '0',
      'is_completed' => '1',
      'is_deactivated' => '0',
      'location_id' => '',
      'user_id_turn' => '1',
      'created' => '2010-07-25 15:35:18',
      'modified' => '2010-10-17 19:02:27',
    ),
    array(
      'id' => '3',
      'name' => 'Invite Only',
      'is_invite_only' => '1',
      'is_completed' => '0',
      'is_deactivated' => '0',
      'location_id' => '',
      'user_id_turn' => '1',
      'created' => '2010-08-27 01:28:02',
      'modified' => '2010-10-23 21:16:00',
    ),
    array(
      'id' => '4',
      'name' => 'Completed and Invite Only',
      'is_invite_only' => '1',
      'is_completed' => '1',
      'is_deactivated' => '0',
      'location_id' => '',
      'user_id_turn' => '1',
      'created' => '2010-08-27 01:28:02',
      'modified' => '2010-10-23 21:16:00',
    ),
    array(
      'id' => '4',
      'name' => 'Deactivated',
      'is_invite_only' => '0',
      'is_completed' => '0',
      'is_deactivated' => '1',
      'location_id' => '',
      'user_id_turn' => '1',
      'created' => '2010-08-27 01:28:02',
      'modified' => '2010-10-23 21:16:00',
    ),
  );
}

?>
