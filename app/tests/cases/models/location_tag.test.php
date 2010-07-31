<?php 
/* SVN FILE: $Id$ */
/* LocationTag Test cases generated on: 2010-07-31 01:18:19 : 1280539099*/
App::import('Model', 'LocationTag');

class LocationTagTestCase extends CakeTestCase {
	var $LocationTag = null;
	var $fixtures = array('app.location_tag');

	function startTest() {
		$this->LocationTag =& ClassRegistry::init('LocationTag');
	}

	function testLocationTagInstance() {
		$this->assertTrue(is_a($this->LocationTag, 'LocationTag'));
	}

	function testLocationTagFind() {
		$this->LocationTag->recursive = -1;
		$results = $this->LocationTag->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LocationTag' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2010-07-31 01:18:19',
			'modified' => '2010-07-31 01:18:19'
		));
		$this->assertEqual($results, $expected);
	}
}
?>