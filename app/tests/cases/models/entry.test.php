<?php 
/* SVN FILE: $Id$ */
/* Entry Test cases generated on: 2010-03-28 14:00:03 : 1269799203*/
App::import('Model', 'Entry');

class EntryTestCase extends CakeTestCase {
	var $Entry = null;
	var $fixtures = array('app.entry', 'app.story', 'app.user');

	function startTest() {
		$this->Entry =& ClassRegistry::init('Entry');
	}

	function testEntryInstance() {
		$this->assertTrue(is_a($this->Entry, 'Entry'));
	}

	function testEntryFind() {
		$this->Entry->recursive = -1;
		$results = $this->Entry->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Entry' => array(
			'id' => 1,
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'is_dialog' => 1,
			'is_deactivated' => 1,
			'story_id' => 1,
			'user_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>