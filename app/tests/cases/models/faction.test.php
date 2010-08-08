<?php 
/* SVN FILE: $Id$ */
/* Faction Test cases generated on: 2010-08-08 12:20:44 : 1281270044*/
App::import('Model', 'Faction');

class FactionTestCase extends CakeTestCase {
	var $Faction = null;
	var $fixtures = array('app.faction');

	function startTest() {
		$this->Faction =& ClassRegistry::init('Faction');
	}

	function testFactionInstance() {
		$this->assertTrue(is_a($this->Faction, 'Faction'));
	}

	function testFactionFind() {
		$this->Faction->recursive = -1;
		$results = $this->Faction->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Faction' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>