<?php 
/* SVN FILE: $Id$ */
/* Chat Test cases generated on: 2010-12-16 19:28:36 : 1292527716*/
App::import('Model', 'Chat');

class ChatTestCase extends CakeTestCase {
	var $Chat = null;
	var $fixtures = array('app.chat', 'app.user');

	function startTest() {
		$this->Chat =& ClassRegistry::init('Chat');
	}

	function testChatInstance() {
		$this->assertTrue(is_a($this->Chat, 'Chat'));
	}

	function testChatFind() {
		$this->Chat->recursive = -1;
		$results = $this->Chat->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Chat' => array(
			'id' => 1,
			'user_id' => 1,
			'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'title' => 'Lorem ipsum dolor sit amet',
			'is_read' => 1,
			'created' => '2010-12-16 19:28:36',
			'modified' => '2010-12-16 19:28:36'
		));
		$this->assertEqual($results, $expected);
	}
}
?>