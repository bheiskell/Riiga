<?php 
/* SVN FILE: $Id$ */
/* Subrace Test cases generated on: 2011-01-07 23:34:04 : 1294443244*/
App::import('Model', 'Subrace');

class SubraceTestCase extends CakeTestCase {
	var $Subrace = null;
	var $fixtures = array('app.subrace', 'app.race', 'app.location', 'app.character');

	function startTest() {
		$this->Subrace =& ClassRegistry::init('Subrace');
	}

	function testSubraceInstance() {
		$this->assertTrue(is_a($this->Subrace, 'Subrace'));
	}

	function testSubraceFind() {
		$this->Subrace->recursive = -1;
		$results = $this->Subrace->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Subrace' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'race_id' => 1,
			'location_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>