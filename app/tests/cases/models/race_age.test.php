<?php 
/* SVN FILE: $Id$ */
/* RaceAge Test cases generated on: 2010-08-08 12:03:33 : 1281269013*/
App::import('Model', 'RaceAge');

class RaceAgeTestCase extends CakeTestCase {
	var $RaceAge = null;
	var $fixtures = array('app.race_age', 'app.race');

	function startTest() {
		$this->RaceAge =& ClassRegistry::init('RaceAge');
	}

	function testRaceAgeInstance() {
		$this->assertTrue(is_a($this->RaceAge, 'RaceAge'));
	}

	function testRaceAgeFind() {
		$this->RaceAge->recursive = -1;
		$results = $this->RaceAge->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('RaceAge' => array(
			'id' => 1,
			'race_id' => 1,
			'child' => 1,
			'teen' => 1,
			'adult' => 1,
			'mature' => 1,
			'elder' => 1,
			'max' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>