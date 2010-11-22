<?php 
/* SVN FILE: $Id$ */
/* CharactersController Test cases generated on: 2010-03-16 18:09:02 : 1268777342*/
App::import('Controller', 'Characters');

class TestCharacters extends CharactersController {
  var $autoRender = false;
}

class CharactersControllerTest extends CakeTestCase {
  var $Characters = null;
  var $fixtures = array(
    'app.character',
    'app.user',
    'app.rank',
    'app.location',
    'app.race',
    'app.faction'
  );

  function startTest() {
    $this->Characters = new TestCharacters();
    $this->Characters->constructClasses();
  }

  function testCharactersControllerInstance() {
    $this->assertTrue(is_a($this->Characters, 'CharactersController'));
  }

  function testIndex() {
    $results = $this->testAction('/characters/index', array(
      'return' => 'vars',
    ));
    $this->assertTrue(3 == count($results['characters']));
    $this->assertTrue(0 == count($results['pendingCharacters']));
  }

  function endTest() {
    unset($this->Characters);
  }
}
?>
