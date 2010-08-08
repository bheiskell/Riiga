<?php 
/* SVN FILE: $Id$ */
/* Race Test cases generated on: 2010-08-07 22:28:16 : 1281220096*/
App::import('Model', 'Race');

class RaceTestCase extends CakeTestCase {
	var $Race = null;
	var $fixtures = array('app.race', 'app.rank', 'app.race_age');

	function startTest() {
		$this->Race =& ClassRegistry::init('Race');
	}

	function testRaceInstance() {
		$this->assertTrue(is_a($this->Race, 'Race'));
	}

	function testRaceFind() {
		$this->Race->recursive = -1;
		$results = $this->Race->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Race' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'rank_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>