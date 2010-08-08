<?php 
/* SVN FILE: $Id$ */
/* ProfessionsRace Test cases generated on: 2010-08-08 14:57:01 : 1281279421*/
App::import('Model', 'ProfessionsRace');

class ProfessionsRaceTestCase extends CakeTestCase {
	var $ProfessionsRace = null;
	var $fixtures = array('app.professions_race', 'app.profession', 'app.race');

	function startTest() {
		$this->ProfessionsRace =& ClassRegistry::init('ProfessionsRace');
	}

	function testProfessionsRaceInstance() {
		$this->assertTrue(is_a($this->ProfessionsRace, 'ProfessionsRace'));
	}

	function testProfessionsRaceFind() {
		$this->ProfessionsRace->recursive = -1;
		$results = $this->ProfessionsRace->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ProfessionsRace' => array(
			'id' => 1,
			'profession_id' => 1,
			'race_id' => 1,
			'age' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>