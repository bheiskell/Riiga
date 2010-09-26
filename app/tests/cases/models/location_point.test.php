<?php 
/* SVN FILE: $Id$ */
/* LocationPoint Test cases generated on: 2010-09-26 22:09:16 : 1285538956*/
App::import('Model', 'LocationPoint');

class LocationPointTestCase extends CakeTestCase {
	var $LocationPoint = null;
	var $fixtures = array('app.location_point', 'app.location');

	function startTest() {
		$this->LocationPoint =& ClassRegistry::init('LocationPoint');
	}

	function testLocationPointInstance() {
		$this->assertTrue(is_a($this->LocationPoint, 'LocationPoint'));
	}

	function testLocationPointFind() {
		$this->LocationPoint->recursive = -1;
		$results = $this->LocationPoint->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LocationPoint' => array(
			'id' => 1,
			'location_id' => 1,
			'x' => 1,
			'y' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>