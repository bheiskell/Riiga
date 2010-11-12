<?php
/**
 * StarsHelper
 *
 * Print out a number of contained stars - used for displaying ranks
 *
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class StarsHelper extends AppHelper {

  var $helpers = array('Html');

  /**
   * render 
   * 
   * @param mixed $rank 
   * @access public
   * @return void
   */
  function render($rank) {
    $stars = implode('<span>&nbsp;</span>', array_fill(0, $rank + 1, ''));
    return $this->Html->div('star', $stars);
  }
}
