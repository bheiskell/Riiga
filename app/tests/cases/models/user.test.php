<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2010-03-15 21:04:04 : 1268701444*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
  var $User = null;
  var $fixtures = array('app.user', 'app.entry');

  function startTest() {
    $this->User =& ClassRegistry::init('User');
  }

  function testUserInstance() {
    $this->assertTrue(is_a($this->User, 'User'));
  }

  function testUserFind() {
    $results = $this->User->find('first');
    $this->assertTrue(isset($results['User']['rank']));
  }

  function testUserFindRankById() {
    $result = $this->User->findRankById(1);
    $this->assertEqual(1, $result);

    $result = $this->User->findRankById(2);
    $this->assertEqual(2, $result);

    $result = $this->User->findRankById(3);
    $this->assertEqual(0, $result);

    $result = $this->User->findRankById(4);
    $this->assertEqual(0, $result);

    $result = $this->User->findRankById(5);
    $this->assertEqual(7, $result);

    $result = $this->User->findRankById(6);
    $this->assertEqual(4, $result);
  }
}
?>
