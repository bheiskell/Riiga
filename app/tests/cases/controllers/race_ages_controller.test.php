<?php 
/* SVN FILE: $Id$ */
/* RaceAgesController Test cases generated on: 2010-08-08 12:15:09 : 1281269709*/
App::import('Controller', 'RaceAges');

class TestRaceAges extends RaceAgesController {
	var $autoRender = false;
}

class RaceAgesControllerTest extends CakeTestCase {
	var $RaceAges = null;

	function startTest() {
		$this->RaceAges = new TestRaceAges();
		$this->RaceAges->constructClasses();
	}

	function testRaceAgesControllerInstance() {
		$this->assertTrue(is_a($this->RaceAges, 'RaceAgesController'));
	}

	function endTest() {
		unset($this->RaceAges);
	}
}
?>