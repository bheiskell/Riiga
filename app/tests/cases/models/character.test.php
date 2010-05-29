<?php 
/* SVN FILE: $Id$ */
/* Character Test cases generated on: 2010-03-15 21:03:16 : 1268701396*/
App::import('Model', 'Character');

class CharacterTestCase extends CakeTestCase {
	var $Character = null;
	var $fixtures = array('app.character', 'app.member');

	function startTest() {
		$this->Character =& ClassRegistry::init('Character');
	}

	function testCharacterInstance() {
		$this->assertTrue(is_a($this->Character, 'Character'));
	}

	function testCharacterFind() {
		$this->Character->recursive = -1;
		$results = $this->Character->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Character' => array(
			'id' => 1,
			'rank' => 1,
			'wallet' => 1,
			'race' => 'Lorem ipsum dolor sit amet',
			'faction' => 'Lorem ipsum dolor sit amet',
			'residency' => 'Lorem ipsum dolor sit amet',
			'profession' => 'Lorem ipsum dolor sit amet',
			'avatar' => 'Lorem ipsum dolor sit amet',
			'member_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>