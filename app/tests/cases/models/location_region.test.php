<?php 
/* SVN FILE: $Id$ */
/* LocationRegion Test cases generated on: 2010-09-26 22:09:46 : 1285538986*/
App::import('Model', 'LocationRegion');

class LocationRegionTestCase extends CakeTestCase {
	var $LocationRegion = null;
	var $fixtures = array('app.location_region', 'app.location');

	function startTest() {
		$this->LocationRegion =& ClassRegistry::init('LocationRegion');
	}

	function testLocationRegionInstance() {
		$this->assertTrue(is_a($this->LocationRegion, 'LocationRegion'));
	}

	function testLocationRegionFind() {
		$this->LocationRegion->recursive = -1;
		$results = $this->LocationRegion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LocationRegion' => array(
			'id' => 1,
			'location_id' => 1,
			'left' => 1,
			'top' => 1,
			'width' => 1,
			'height' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>