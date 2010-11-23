<?php
App::import('Model', 'Character');

class CharacterTestCase extends CakeTestCase {
  var $Character = null;
  var $fixtures = array('app.character', 'app.characters_story');

  function startTest() {
    $this->Character =& ClassRegistry::init('Character');
  }

  function testCharacterInstance() {
    $this->assertTrue(is_a($this->Character, 'Character'));
  }

  function testCharacterFindAvailable() {
    $results = $this->Character->find('available');
    $this->assertFalse($results);

    $results = $this->Character->find('available', -1);
    $this->assertFalse($results);

    $results = $this->Character->find('available', 0);
    $this->assertFalse($results);

    $results = $this->Character->find('available', 1);
    $this->assertEqual($results, array('1' => 'Test Character 1'));

    $results = $this->Character->find('available', 2);
    $this->assertEqual($results, array('2' => 'Test Character 2'));

    $results = $this->Character->find('available', 3);
    $this->assertFalse($results);

    $results = $this->Character->find('available', 4);
    $this->assertEqual($results, array('4' => 'New Character'));
  }

  function testCharacterAddHighRank() {
    $data = array(
      'name' => 'Test Character',
      'description' => 'Description Text',
      'history' => 'History Text',
      'rank_id' => '1',
      'location_id' => '4',
      'race_id' => '1',
      'faction_id' => '',
      'age' => '11',
      'profession' => 'Herb Farmer',
      'avatar' => '',
      'is_npc' => '0',
      'is_deactivated' => '0',
      'user_id' => '1',
      'created' => '2010-08-10 23:21:21',
      'modified' => '2010-10-03 00:20:01',
    );
    $result = $this->Character->save($data);
    $this->assertTrue($result);

    $data['rank_id'] = 2;
    $result = $this->Character->save($data);
    $this->assertFalse($result);

    // Check a user with no posts
    $data['rank_id'] = 1;
    $data['user_id'] = 3;
    $result = $this->Character->save($data);
    $this->assertTrue($result);

    $data['rank_id'] = 2;
    $result = $this->Character->save($data);
    $this->assertFalse($result);

    $this->assertTrue($this->Character->delete(false, false));
  }
}
?>
