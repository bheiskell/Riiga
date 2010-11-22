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
  }
}
?>
