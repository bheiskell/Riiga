<?php
/**
 * MinimapHelper
 *
 * When time is avaliable, writing a controller that will serve portions of the
 * map with dots dropped accordingly would be extremely benificial. This would
 * allow this helper to not have to load the huge map image to pan around
 * it.
 *
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class MinimapHelper extends AppHelper {

  var $helpers = array('Html');

  var $imageWidth  = 3314;
  var $imageHeight = 2441;

  var $frameWidth  = 200;
  var $frameHeight = 147.314; // width * imageheight / imagewidth

  /**
   * _translate
   *
   * Helper to translate the percent to pixels in reference to the image size
   *
   * @param mixed $percentX Percent X
   * @param mixed $percentY Percent Y
   * @access private
   * @return array array(x in px, y in px)
   */
  private function _translate($percentX, $percentY) {
    return array(
      $this->imageWidth  * $percentX / 100.0,
      $this->imageHeight * $percentY / 100.0
    );
  }

  /**
   * render
   *
   * Drops an image positioned to display the correct region.
   *
   * @param mixed $left   Percent left
   * @param mixed $top    Percent top
   * @param mixed $width  Percent width
   * @param mixed $height Percent height
   * @param mixed $x Percent point x
   * @param mixed $y Percent point y
   * @access public
   * @return string Div with image positioned using hardcoded CSS (gross)
   */
  function render($left, $top, $width, $height, $x = false, $y = false) {

    /* Basically a direct port of the JS image region calculations */

    // Because container is in pixels convert from percents
    list($posX, $posY) = $this->_translate($left, $top);
    list($dimX, $dimY) = $this->_translate($width, $height);

    // Zoom based on ratio of container to region dimension
    $zoomX = $this->frameWidth  / $dimX;
    $zoomY = $this->frameHeight / $dimY;

    // Use smaller zoom to ensure full map in sight
    $zoom = ($zoomX < $zoomY) ? $zoomX : $zoomY;

    // When zooming on one dimension, offset the other to centered focal point
    $offsetX = ($zoomX < $zoomY) ? 0 : ($zoomX - $zoomY) * $dimX / 2;
    $offsetY = ($zoomX > $zoomY) ? 0 : ($zoomY - $zoomX) * $dimY / 2;

    // Top left position taking into account offset
    $positionX = $posX * $zoom - $offsetX;
    $positionY = $posY * $zoom - $offsetY;

    // Image size, not container, needs to be used for zooming
    $dimensionX = $this->imageWidth * $zoom;
    $dimensionY = $this->imageHeight * $zoom;

    return $this->Html->div(
      'ui-location',
      $this->Html->image(
        'map/riiga.jpg',
        array(
          'style' => implode(';', array(
            'left:  -' . $positionX  . 'px',
            'top:   -' . $positionY  . 'px',
            'width:  ' . $dimensionX . 'px',
            'height: ' . $dimensionY . 'px',
          ))
        )
      ),
      array(
        'style' => implode(';', array(
          'width:  ' . $this->frameWidth  . 'px',
          'height: ' . $this->frameHeight . 'px',
        ))
      )
    );
  }
}
