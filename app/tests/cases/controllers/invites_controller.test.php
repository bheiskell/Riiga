<?php 
/* SVN FILE: $Id$ */
/* InvitesController Test cases generated on: 2010-11-29 00:36:27 : 1290990987*/
App::import('Controller', 'Invites');

class TestInvites extends InvitesController {
	var $autoRender = false;
}

class InvitesControllerTest extends CakeTestCase {
	var $Invites = null;

	function startTest() {
		$this->Invites = new TestInvites();
		$this->Invites->constructClasses();
	}

	function testInvitesControllerInstance() {
		$this->assertTrue(is_a($this->Invites, 'InvitesController'));
	}

	function endTest() {
		unset($this->Invites);
	}
}
?>