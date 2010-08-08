<?php 
/* SVN FILE: $Id$ */
/* ProfessionsRacesController Test cases generated on: 2010-08-08 14:57:39 : 1281279459*/
App::import('Controller', 'ProfessionsRaces');

class TestProfessionsRaces extends ProfessionsRacesController {
	var $autoRender = false;
}

class ProfessionsRacesControllerTest extends CakeTestCase {
	var $ProfessionsRaces = null;

	function startTest() {
		$this->ProfessionsRaces = new TestProfessionsRaces();
		$this->ProfessionsRaces->constructClasses();
	}

	function testProfessionsRacesControllerInstance() {
		$this->assertTrue(is_a($this->ProfessionsRaces, 'ProfessionsRacesController'));
	}

	function endTest() {
		unset($this->ProfessionsRaces);
	}
}
?>