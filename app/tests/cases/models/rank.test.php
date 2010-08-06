<?php 
/* SVN FILE: $Id$ */
/* Rank Test cases generated on: 2010-08-06 01:32:57 : 1281058377*/
App::import('Model', 'Rank');

class RankTestCase extends CakeTestCase {
	var $Rank = null;
	var $fixtures = array('app.rank');

	function startTest() {
		$this->Rank =& ClassRegistry::init('Rank');
	}

	function testRankInstance() {
		$this->assertTrue(is_a($this->Rank, 'Rank'));
	}

	function testRankFind() {
		$this->Rank->recursive = -1;
		$results = $this->Rank->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Rank' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'entry_count' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>