<?php
App::import('Helper', 'Date');
App::import('Helper', 'Time');

class TestDate extends DateHelper {
}

class DateHelperTest extends CakeTestCase {

  function startTest() {
    $this->Date       = new TestDate();
    $this->Date->Time = new TimeHelper();
  }

  function testDateInstance() {
    $this->assertTrue(is_a($this->Date, 'DateHelper'));
  }

  function testDateDate() {
    $this->assertEqual('02/08/07', $this->Date->date('2007-08-02 00:00:00'));
    $this->assertEqual('1 hour ago', $this->Date->date(time() - 60*60));
  }

  function testDateTime() {
    $this->assertEqual('02/08/07 00:00', $this->Date->time('2007-08-02 00:00:00'));
    $this->assertEqual('1 hour ago', $this->Date->time(time() - 60*60));
  }
}
?>
