<?php 
/* SVN FILE: $Id$ */
/* CharacterLocationsController Test cases generated on: 2010-08-06 01:40:40 : 1281058840*/
App::import('Controller', 'CharacterLocations');

class TestCharacterLocations extends CharacterLocationsController {
	var $autoRender = false;
}

class CharacterLocationsControllerTest extends CakeTestCase {
	var $CharacterLocations = null;

	function startTest() {
		$this->CharacterLocations = new TestCharacterLocations();
		$this->CharacterLocations->constructClasses();
	}

	function testCharacterLocationsControllerInstance() {
		$this->assertTrue(is_a($this->CharacterLocations, 'CharacterLocationsController'));
	}

	function endTest() {
		unset($this->CharacterLocations);
	}
}
?>