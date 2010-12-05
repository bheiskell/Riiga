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
   * Render some number of stars based on a user's rank.
   *
   * @param mixed $rank
   * @access public
   * @return string Html output of the star div
   */
  public function render($rank) {
    $stars = implode('<span>&nbsp;</span>', array_fill(0, $rank + 1, ''));
    return $this->Html->div('star', $stars);
  }
}
