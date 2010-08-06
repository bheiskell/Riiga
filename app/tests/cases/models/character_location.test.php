<?php 
/* SVN FILE: $Id$ */
/* CharacterLocation Test cases generated on: 2010-08-06 01:35:45 : 1281058545*/
App::import('Model', 'CharacterLocation');

class CharacterLocationTestCase extends CakeTestCase {
	var $CharacterLocation = null;
	var $fixtures = array('app.character_location', 'app.location', 'app.rank');

	function startTest() {
		$this->CharacterLocation =& ClassRegistry::init('CharacterLocation');
	}

	function testCharacterLocationInstance() {
		$this->assertTrue(is_a($this->CharacterLocation, 'CharacterLocation'));
	}

	function testCharacterLocationFind() {
		$this->CharacterLocation->recursive = -1;
		$results = $this->CharacterLocation->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('CharacterLocation' => array(
			'id' => 1,
			'location_id' => 1,
			'rank_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>