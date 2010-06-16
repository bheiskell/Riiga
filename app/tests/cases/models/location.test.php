<?php 
/* SVN FILE: $Id$ */
/* Location Test cases generated on: 2010-06-16 19:54:41 : 1276718081*/
App::import('Model', 'Location');

class LocationTestCase extends CakeTestCase {
	var $Location = null;
	var $fixtures = array('app.location');

	function startTest() {
		$this->Location =& ClassRegistry::init('Location');
	}

	function testLocationInstance() {
		$this->assertTrue(is_a($this->Location, 'Location'));
	}

	function testLocationFind() {
		$this->Location->recursive = -1;
		$results = $this->Location->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Location' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 1,
			'created' => '2010-06-16 19:54:41',
			'modified' => '2010-06-16 19:54:41'
		));
		$this->assertEqual($results, $expected);
	}
}
?>