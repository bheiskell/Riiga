<?php
/**
 * AltrowHelper
 * Centralize alternate row logic. There are more advanced utilities that
 * perform this task, but I wanted something that would require the minimal
 * amount of work to accomplish my use case
 * 
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class AltrowHelper extends AppHelper {
  private $_count = 0;

  public function reset() {
    $this->_count = 0;
  }

  private function isEven() {
    return (0 == $this->_count % 2);
  }

  /**
   * get Get the current altrow class. 
   *
   * @param String variable arguments representing class names
   * @access public
   * @return Class string including class="" if needed
   */
  public function get() {
    $classes = func_get_args();

    if ($this->isEven()) $classes[] = 'altrow';

    $this->_count++;

    return (empty($classes)) ? '' : (' class="' . implode(' ', $classes) . '"');
  }

  public function __toString() {
    return $this->get();
  }
}
