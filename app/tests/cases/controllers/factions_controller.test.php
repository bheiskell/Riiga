<?php 
/* SVN FILE: $Id$ */
/* FactionsController Test cases generated on: 2010-08-08 12:21:02 : 1281270062*/
App::import('Controller', 'Factions');

class TestFactions extends FactionsController {
	var $autoRender = false;
}

class FactionsControllerTest extends CakeTestCase {
	var $Factions = null;

	function startTest() {
		$this->Factions = new TestFactions();
		$this->Factions->constructClasses();
	}

	function testFactionsControllerInstance() {
		$this->assertTrue(is_a($this->Factions, 'FactionsController'));
	}

	function endTest() {
		unset($this->Factions);
	}
}
?>