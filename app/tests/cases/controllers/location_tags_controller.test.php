<?php 
/* SVN FILE: $Id$ */
/* LocationTagsController Test cases generated on: 2010-07-31 01:19:09 : 1280539149*/
App::import('Controller', 'LocationTags');

class TestLocationTags extends LocationTagsController {
	var $autoRender = false;
}

class LocationTagsControllerTest extends CakeTestCase {
	var $LocationTags = null;

	function startTest() {
		$this->LocationTags = new TestLocationTags();
		$this->LocationTags->constructClasses();
	}

	function testLocationTagsControllerInstance() {
		$this->assertTrue(is_a($this->LocationTags, 'LocationTagsController'));
	}

	function endTest() {
		unset($this->LocationTags);
	}
}
?>