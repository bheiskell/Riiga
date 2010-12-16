<?php 
/* SVN FILE: $Id$ */
/* Message Test cases generated on: 2010-12-16 19:27:22 : 1292527642*/
App::import('Model', 'Message');

class MessageTestCase extends CakeTestCase {
	var $Message = null;
	var $fixtures = array('app.message', 'app.user', 'app.user');

	function startTest() {
		$this->Message =& ClassRegistry::init('Message');
	}

	function testMessageInstance() {
		$this->assertTrue(is_a($this->Message, 'Message'));
	}

	function testMessageFind() {
		$this->Message->recursive = -1;
		$results = $this->Message->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Message' => array(
			'id' => 1,
			'recv_user_id' => 1,
			'send_user_id' => 1,
			'message' => 'Lorem ipsum dolor sit amet',
			'is_read' => 1,
			'created' => '2010-12-16 19:27:22',
			'modified' => '2010-12-16 19:27:22'
		));
		$this->assertEqual($results, $expected);
	}
}
?>