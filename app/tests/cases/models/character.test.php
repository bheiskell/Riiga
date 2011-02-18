<?php
App::import('Model', 'Character');
App::import('Core', 'Security');

class CharacterTestCase extends CakeTestCase {
  var $Character = null;
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
    $this->Character =& ClassRegistry::init('Character');
    $this->Entry     =& ClassRegistry::init('Entry');
  }

  function testCharacterInstance() {
    $this->assertTrue(is_a($this->Character, 'Character'));
  }

  function testCharacterFixture() {
    $result = $this->Character->findById(1);

    $this->assertFalse(empty($result));

    $this->data = $result['Character'];

    $this->assertEqual(1, $this->data['user_id']);

    $this->assertEqual(1, $this->Entry->find('count', array(
      'conditions' => array('user_id' => $this->data['user_id'])
    )));

    $this->assertTrue($this->Character->save($this->data));
  }

  function testCharacterCheckRank() {
    $data = $this->data;

    $entry = $this->Entry->find('first');
    $this->Entry->id = $entry['Entry']['id'];

    $this->assertTrue($this->Entry->delete());
    $this->assertTrue($this->Character->save($data));

    $data['rank_id'] = 2;
    $this->assertFalse($this->Character->save($data));
  }

  function drop(&$db) { return true; }
}
?>
