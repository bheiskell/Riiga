<?php 
App::import('Controller', 'Characters');

class TestCharacters extends CharactersController {
  var $autoRender = false;
}

class CharactersControllerTest extends CakeTestCase {
  var $Characters = null;
  /*var $fixtures = array(
    'app.character',
    'app.user',
    'app.rank',
    'app.location',
    'app.race',
    'app.faction',
  );*/

  function startTest() {
    /*
    $this->Characters = new TestCharacters();
    $this->Characters->constructClasses();
  }

  function testCharactersControllerInstance() {
    $this->assertTrue(is_a($this->Characters, 'CharactersController'));
  }

  function testIndex() {
    /*
    $results = $this->testAction('/characters/index', array(
      'return' => 'vars',
    ));
    $this->assertTrue(1 == count($results['characters']));
    $this->assertTrue(0 == count($results['pendingCharacters']));
    */
  }
}
?>
