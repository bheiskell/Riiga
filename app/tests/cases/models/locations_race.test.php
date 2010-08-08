<?php 
/* SVN FILE: $Id$ */
/* LocationsRace Test cases generated on: 2010-08-08 00:04:31 : 1281225871*/
App::import('Model', 'LocationsRace');

class LocationsRaceTestCase extends CakeTestCase {
	var $LocationsRace = null;
	var $fixtures = array('app.locations_race', 'app.location', 'app.race');

	function startTest() {
		$this->LocationsRace =& ClassRegistry::init('LocationsRace');
	}

	function testLocationsRaceInstance() {
		$this->assertTrue(is_a($this->LocationsRace, 'LocationsRace'));
	}

	function testLocationsRaceFind() {
		$this->LocationsRace->recursive = -1;
		$results = $this->LocationsRace->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LocationsRace' => array(
			'id' => 1,
			'location_id' => 1,
			'race_id' => 1,
			'likelihood' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>