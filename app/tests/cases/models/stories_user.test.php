<?php 
/* SVN FILE: $Id$ */
/* StoriesUser Test cases generated on: 2010-11-29 00:54:38 : 1290992078*/
App::import('Model', 'StoriesUser');

class StoriesUserTestCase extends CakeTestCase {
	var $StoriesUser = null;
	var $fixtures = array('app.stories_user', 'app.story', 'app.user');

	function startTest() {
		$this->StoriesUser =& ClassRegistry::init('StoriesUser');
	}

	function testStoriesUserInstance() {
		$this->assertTrue(is_a($this->StoriesUser, 'StoriesUser'));
	}

	function testStoriesUserFind() {
		$this->StoriesUser->recursive = -1;
		$results = $this->StoriesUser->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('StoriesUser' => array(
			'id' => 1,
			'story_id' => 1,
			'user_id' => 1,
			'is_moderator' => 1,
			'is_deactivated' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>