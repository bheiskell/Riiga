<?php 
/* SVN FILE: $Id$ */
/* FactionRanksController Test cases generated on: 2010-08-08 12:27:02 : 1281270422*/
App::import('Controller', 'FactionRanks');

class TestFactionRanks extends FactionRanksController {
	var $autoRender = false;
}

class FactionRanksControllerTest extends CakeTestCase {
	var $FactionRanks = null;

	function startTest() {
		$this->FactionRanks = new TestFactionRanks();
		$this->FactionRanks->constructClasses();
	}

	function testFactionRanksControllerInstance() {
		$this->assertTrue(is_a($this->FactionRanks, 'FactionRanksController'));
	}

	function endTest() {
		unset($this->FactionRanks);
	}
}
?>