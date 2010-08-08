<?php 
/* SVN FILE: $Id$ */
/* LocationsRacesController Test cases generated on: 2010-08-08 00:08:03 : 1281226083*/
App::import('Controller', 'LocationsRaces');

class TestLocationsRaces extends LocationsRacesController {
	var $autoRender = false;
}

class LocationsRacesControllerTest extends CakeTestCase {
	var $LocationsRaces = null;

	function startTest() {
		$this->LocationsRaces = new TestLocationsRaces();
		$this->LocationsRaces->constructClasses();
	}

	function testLocationsRacesControllerInstance() {
		$this->assertTrue(is_a($this->LocationsRaces, 'LocationsRacesController'));
	}

	function endTest() {
		unset($this->LocationsRaces);
	}
}
?>