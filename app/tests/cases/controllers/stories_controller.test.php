<?php 
/* SVN FILE: $Id$ */
/* StoriesController Test cases generated on: 2010-03-28 14:47:33 : 1269802053*/
App::import('Controller', 'Stories');

class TestStories extends StoriesController {
	var $autoRender = false;
}

class StoriesControllerTest extends CakeTestCase {
	var $Stories = null;

	function startTest() {
		$this->Stories = new TestStories();
		$this->Stories->constructClasses();
	}

	function testStoriesControllerInstance() {
		$this->assertTrue(is_a($this->Stories, 'StoriesController'));
	}

	function endTest() {
		unset($this->Stories);
	}
}
?>