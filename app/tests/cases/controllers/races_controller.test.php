<?php 
/* SVN FILE: $Id$ */
/* RacesController Test cases generated on: 2010-08-07 22:37:43 : 1281220663*/
App::import('Controller', 'Races');

class TestRaces extends RacesController {
	var $autoRender = false;
}

class RacesControllerTest extends CakeTestCase {
	var $Races = null;

	function startTest() {
		$this->Races = new TestRaces();
		$this->Races->constructClasses();
	}

	function testRacesControllerInstance() {
		$this->assertTrue(is_a($this->Races, 'RacesController'));
	}

	function endTest() {
		unset($this->Races);
	}
}
?>