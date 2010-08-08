<?php 
/* SVN FILE: $Id$ */
/* Profession Test cases generated on: 2010-08-08 14:55:52 : 1281279352*/
App::import('Model', 'Profession');

class ProfessionTestCase extends CakeTestCase {
	var $Profession = null;
	var $fixtures = array('app.profession', 'app.profession_category');

	function startTest() {
		$this->Profession =& ClassRegistry::init('Profession');
	}

	function testProfessionInstance() {
		$this->assertTrue(is_a($this->Profession, 'Profession'));
	}

	function testProfessionFind() {
		$this->Profession->recursive = -1;
		$results = $this->Profession->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Profession' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'profession_category_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>