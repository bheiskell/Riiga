<?php 
/* SVN FILE: $Id$ */
/* ProfessionCategory Test cases generated on: 2010-08-08 14:56:27 : 1281279387*/
App::import('Model', 'ProfessionCategory');

class ProfessionCategoryTestCase extends CakeTestCase {
	var $ProfessionCategory = null;
	var $fixtures = array('app.profession_category', 'app.profession');

	function startTest() {
		$this->ProfessionCategory =& ClassRegistry::init('ProfessionCategory');
	}

	function testProfessionCategoryInstance() {
		$this->assertTrue(is_a($this->ProfessionCategory, 'ProfessionCategory'));
	}

	function testProfessionCategoryFind() {
		$this->ProfessionCategory->recursive = -1;
		$results = $this->ProfessionCategory->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ProfessionCategory' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>