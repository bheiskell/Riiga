<?php 
/* SVN FILE: $Id$ */
/* PendingCharacter Test cases generated on: 2010-10-30 19:03:49 : 1288465429*/
App::import('Model', 'PendingCharacter');

class PendingCharacterTestCase extends CakeTestCase {
	var $PendingCharacter = null;
	var $fixtures = array('app.pending_character');

	function startTest() {
		$this->PendingCharacter =& ClassRegistry::init('PendingCharacter');
	}

	function testPendingCharacterInstance() {
		$this->assertTrue(is_a($this->PendingCharacter, 'PendingCharacter'));
	}

	function testPendingCharacterFind() {
		$this->PendingCharacter->recursive = -1;
		$results = $this->PendingCharacter->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('PendingCharacter' => array(
			'pending_id' => 1,
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'history' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'rank_id' => 1,
			'location_id' => 1,
			'race_id' => 1,
			'faction_id' => 1,
			'age' => 'Lorem ipsum dolor sit amet',
			'profession' => 'Lorem ipsum dolor sit amet',
			'avatar' => 'Lorem ipsum dolor sit amet',
			'is_npc' => 1,
			'is_deactivated' => 1,
			'user_id' => 1,
			'created' => '2010-10-30 19:03:49',
			'modified' => '2010-10-30 19:03:49'
		));
		$this->assertEqual($results, $expected);
	}
}
?>