<?php
/**
 * DateHelper
 *
 * Provide a single location to transform dates for display
 *
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com>
 */
class DateHelper extends AppHelper {

  var $helpers = array('Time');

  /**
   * date
   *
   * Display information to day granularity
   *
   * @param mixed $date 
   * @access public
   * @return string
   */
  public function date($date) {
    if (!$date) { return ''; }

    $full = $this->Time->relativeTime($date, 'd/m/y');

    return ($pos = strpos($full, ','))
      ? substr($full, 0 , pos) . ' ago'
      : $this->dropOn($full);
  }

  /**
   * time
   *
   * Display information to second granularity
   *
   * @param mixed $date
   * @access public
   * @return string
   */
  public function time($date) {
    if (!$date) { return ''; }

    return $this->dropOn($this->Time->relativeTime($date, 'd/m/y H:i'));
  }

  /**
   * dropOn
   *
   * Replace the 'on ' prefix with nothing
   *
   * @param mixed $date
   * @access private
   * @return string
   */
  private function dropOn($date) {
    return str_replace('on ', '', $date);
  }
}
