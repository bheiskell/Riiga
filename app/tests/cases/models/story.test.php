<?php
App::import('Model', 'Story');
App::import('Core', 'Security');

class StoryTestCase extends CakeTestCase {
  var $Story = null;
  var $fixtures = array(
    'app.character',
    'app.character_location',
    'app.location',
    'app.locations_race',
    'app.location_region',
    'app.location_point',
    'app.location_tag',
    'app.location_tags_location',
    'app.rank',
    'app.race',
    'app.race_age',
    'app.rank',
    'app.faction',
    'app.faction_rank',
    'app.factions_race',
    'app.subrace',
    'app.pending_character',
    'app.profession',
    'app.professions_race',
    'app.profession_category',
    'app.user',
    'app.entry',
    'app.story',
    'app.stories_user',
    'app.characters_story',
    'app.characters_entry',
  );

  function startTest() {
    $this->Story =& ClassRegistry::init('Story');
    $this->Entry     =& ClassRegistry::init('Entry');
  }

  function testStoryInstance() {
    $this->assertTrue(is_a($this->Story, 'Story'));
  }

  function testStoryFixture() {
    $result = $this->Story->findById(1);

    $this->assertFalse(empty($result));

    $this->data = $result['Story'];

    $this->assertEqual(1, $this->Entry->find('count', array(
      'conditions' => array('story_id' => $this->data['id'])
    )));

    $this->assertTrue($this->Story->save($this->data));
  }

  function testStoryFindLastFiveEntries() {
    $this->assertEqual(1, count($this->Story->find('last_five_entries', 1)));

    $this->assertTrue($this->Story->addCharacter(1, 1, 1));
    $this->assertTrue($this->Story->addCharacter(1, 2, 2));
    for ($i = 0; $i < 6; $i++) {
      $this->Entry->create();
      $this->assertTrue($this->Entry->save(array(
        'story_id' => 1,
        'user_id'  => (0 == $i % 2) ? 2 : 1,
        'content'  => 'Test content: ' . $i,
      )));
    }
    $entries = $this->Story->find('last_five_entries', 1);
    $this->assertEqual(5, count($entries));

    $this->assertEqual('Test content: 5', $entries[0]['Entry']['content']);
  }
}
?>
