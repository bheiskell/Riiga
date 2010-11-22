<?php
class CharactersStoryFixture extends CakeTestFixture {
  var $name = 'CharactersStory';
  var $import = array('table' => 'characters_stories');
  var $records = array(
    // Entered a story and left to another story
    array(
      'id' => '1',
      'character_id' => '1',
      'story_id' => '1',
      'is_active' => '0',
    ),
    array(
      'id' => '2',
      'character_id' => '1',
      'story_id' => '2',
      'is_active' => '1',
    ),
    // Entered a story and left
    array(
      'id' => '3',
      'character_id' => '2',
      'story_id' => '1',
      'is_active' => '0',
    ),
    // Entered a story and remains
    array(
      'id' => '4',
      'character_id' => '3',
      'story_id' => '1',
      'is_active' => '1',
    ),
  );
}
?>
