<?php 
/* SVN FILE: $Id$ */
/* CharactersStory Test cases generated on: 2010-11-29 00:55:15 : 1290992115*/
App::import('Model', 'CharactersStory');

class CharactersStoryTestCase extends CakeTestCase {
	var $CharactersStory = null;
	var $fixtures = array('app.characters_story', 'app.character', 'app.story');

	function startTest() {
		$this->CharactersStory =& ClassRegistry::init('CharactersStory');
	}

	function testCharactersStoryInstance() {
		$this->assertTrue(is_a($this->CharactersStory, 'CharactersStory'));
	}

	function testCharactersStoryFind() {
		$this->CharactersStory->recursive = -1;
		$results = $this->CharactersStory->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('CharactersStory' => array(
			'id' => 1,
			'character_id' => 1,
			'story_id' => 1,
			'is_deactivated' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>