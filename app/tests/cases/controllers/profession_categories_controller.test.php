<?php 
/* SVN FILE: $Id$ */
/* ProfessionCategoriesController Test cases generated on: 2010-08-08 14:57:20 : 1281279440*/
App::import('Controller', 'ProfessionCategories');

class TestProfessionCategories extends ProfessionCategoriesController {
	var $autoRender = false;
}

class ProfessionCategoriesControllerTest extends CakeTestCase {
	var $ProfessionCategories = null;

	function startTest() {
		$this->ProfessionCategories = new TestProfessionCategories();
		$this->ProfessionCategories->constructClasses();
	}

	function testProfessionCategoriesControllerInstance() {
		$this->assertTrue(is_a($this->ProfessionCategories, 'ProfessionCategoriesController'));
	}

	function endTest() {
		unset($this->ProfessionCategories);
	}
}
?>