<?php 
/* SVN FILE: $Id$ */
/* Story Test cases generated on: 2010-03-28 14:47:04 : 1269802024*/
App::import('Model', 'Story');

class StoryTestCase extends CakeTestCase {
	var $Story = null;
	var $fixtures = array('app.story', 'app.user', 'app.entry');

	function startTest() {
		$this->Story =& ClassRegistry::init('Story');
	}

	function testStoryInstance() {
		$this->assertTrue(is_a($this->Story, 'Story'));
	}

	function testStoryFind() {
		$this->Story->recursive = -1;
		$results = $this->Story->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Story' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'is_invite_only' => 1,
			'is_completed' => 1,
			'is_deactivated' => 1,
			'location_id' => 1,
			'user_id_turn' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>