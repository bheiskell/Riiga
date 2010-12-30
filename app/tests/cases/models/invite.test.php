<?php 
/* SVN FILE: $Id$ */
/* Invite Test cases generated on: 2010-12-27 15:55:31 : 1293465331*/
App::import('Model', 'Invite');

class InviteTestCase extends CakeTestCase {
	var $Invite = null;
	var $fixtures = array('app.invite', 'app.story', 'app.user');

	function startTest() {
		$this->Invite =& ClassRegistry::init('Invite');
	}

	function testInviteInstance() {
		$this->assertTrue(is_a($this->Invite, 'Invite'));
	}

	function testInviteFind() {
		$this->Invite->recursive = -1;
		$results = $this->Invite->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Invite' => array(
			'id' => 1,
			'story_id' => 1,
			'user_id' => 1,
			'created' => '2010-12-27 15:55:31',
			'modified' => '2010-12-27 15:55:31'
		));
		$this->assertEqual($results, $expected);
	}
}
?>