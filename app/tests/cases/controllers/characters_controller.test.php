<?php 
/* SVN FILE: $Id$ */
/* CharactersController Test cases generated on: 2010-03-16 18:09:02 : 1268777342*/
App::import('Controller', 'Characters');

class TestCharacters extends CharactersController {
	var $autoRender = false;
}

class CharactersControllerTest extends CakeTestCase {
	var $Characters = null;

	function startTest() {
		$this->Characters = new TestCharacters();
		$this->Characters->constructClasses();
	}

	function testCharactersControllerInstance() {
		$this->assertTrue(is_a($this->Characters, 'CharactersController'));
	}

	function endTest() {
		unset($this->Characters);
	}
}
?>