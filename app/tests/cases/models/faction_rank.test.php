<?php 
/* SVN FILE: $Id$ */
/* FactionRank Test cases generated on: 2010-08-08 12:25:46 : 1281270346*/
App::import('Model', 'FactionRank');

class FactionRankTestCase extends CakeTestCase {
	var $FactionRank = null;
	var $fixtures = array('app.faction_rank', 'app.faction', 'app.rank');

	function startTest() {
		$this->FactionRank =& ClassRegistry::init('FactionRank');
	}

	function testFactionRankInstance() {
		$this->assertTrue(is_a($this->FactionRank, 'FactionRank'));
	}

	function testFactionRankFind() {
		$this->FactionRank->recursive = -1;
		$results = $this->FactionRank->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('FactionRank' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'faction_id' => 1,
			'rank_id' => 1,
			'age' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>