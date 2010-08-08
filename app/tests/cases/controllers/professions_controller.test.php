<?php 
/* SVN FILE: $Id$ */
/* ProfessionsController Test cases generated on: 2010-08-08 14:57:34 : 1281279454*/
App::import('Controller', 'Professions');

class TestProfessions extends ProfessionsController {
	var $autoRender = false;
}

class ProfessionsControllerTest extends CakeTestCase {
	var $Professions = null;

	function startTest() {
		$this->Professions = new TestProfessions();
		$this->Professions->constructClasses();
	}

	function testProfessionsControllerInstance() {
		$this->assertTrue(is_a($this->Professions, 'ProfessionsController'));
	}

	function endTest() {
		unset($this->Professions);
	}
}
?>