<?php 
/* SVN FILE: $Id$ */
/* RanksController Test cases generated on: 2010-08-06 01:33:13 : 1281058393*/
App::import('Controller', 'Ranks');

class TestRanks extends RanksController {
	var $autoRender = false;
}

class RanksControllerTest extends CakeTestCase {
	var $Ranks = null;

	function startTest() {
		$this->Ranks = new TestRanks();
		$this->Ranks->constructClasses();
	}

	function testRanksControllerInstance() {
		$this->assertTrue(is_a($this->Ranks, 'RanksController'));
	}

	function endTest() {
		unset($this->Ranks);
	}
}
?>