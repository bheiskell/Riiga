<?php
/**
 * MinimapHelper
 *
 * Render a portion of the map. Saves crops in a temporary directory and uses
 * the html helper to display them.
 *
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com>
 */
class MinimapHelper extends AppHelper {

  var $helpers = array('Html');

  /**
   * mapFile
   *
   * Path to the map file starting at IMAGES. Constructed in beforeRender.
   *
   * @var mixed
   * @access private
   */
  private $mapFile   = null;

  /**
   * cacheFile
   *
   * This is the cache file prefix. Path to the cache file starting at IMAGES.
   * Constructed in beforeRender.
   *
   * @var mixed
   * @access private
   */
  private $cacheFile = null;

  /**
   * mapFileFullPath
   *
   * Full path of the mapFile.
   *
   * @var mixed
   * @access private
   */
  private $mapFileFullPath   = null;

  /**
   * cacheFileFullPath 
   *
   * Full path of the cacheFile.
   *
   * @var mixed
   * @access private
   */
  private $cacheFileFullPath = null;

  /**
   * width
   *
   * Width of the mapFile
   *
   * @var mixed
   * @access private
   */
  private $width  = null;

  /**
   * height
   *
   * Height of the mapFile.
   *
   * @var mixed
   * @access private
   */
  private $height = null;

  /**
   * beforeRender
   *
   * Initialize paths and obtain image size.
   *
   * @access public
   * @return void
   */
  public function beforeRender() {
    $this->mapFile   = 'map' . DS . 'riiga.jpg';
    $this->cacheFile = 'map' . DS . 'cache' . DS;

    $this->mapFileFullPath   = IMAGES . DS . $this->mapFile;
    $this->cacheFileFullPath = IMAGES . DS . $this->cacheFile;

    if (is_readable($this->mapFileFullPath)) {
      list($this->width, $this->height) = getimagesize($this->mapFileFullPath);
      $this->log(__('MinimapHelper->_path: map is not readable', true));
    }
  }

  /**
   * _path
   *
   * Obtain the path to an image according to the arguments passed. This will
   * render and save the image in the event it does not exist.
   *
   * @param mixed $img_width
   * @param mixed $img_height
   * @param mixed $left
   * @param mixed $top
   * @param mixed $width
   * @param mixed $height
   * @access private
   * @return string Path to image
   */
  private function _path(
    $img_width, $img_height, $left, $top, $width, $height
  ) {
    $postfix = $img_width  . 'x'
             . $img_height . ':'
             . $left       . '_'
             . $top        . '_'
             . $width      . '_'
             . $height     . '.jpg';

    $file         = $this->cacheFile         . $postfix;
    $fileFullPath = $this->cacheFileFullPath . $postfix;

    if (!is_readable($this->mapFileFullPath)
     || !is_writable($this->cacheFileFullPath)
    ) {
      $this->log(__('MinimapHelper->_path: file access issues', true));
      return false;
    }

    if (!is_file($fileFullPath)) {
      $map  = imagecreatefromjpeg($this->mapFileFullPath);
      $crop = imagecreatetruecolor($img_width, $img_height);

      imagecopyresampled(
        $crop,      $map,
        0,          0,
        $left,      $top,
        $img_width, $img_height,
        $width,     $height
      );

      imagejpeg($crop, $fileFullPath, 100); // save at full quality
      imagedestroy($map);
      imagedestroy($crop);
    }

    return $file;
  }

  /**
   * _translate
   *
   * Helper to translate the percent to pixels in reference to the image size
   *
   * @param array $region Array keyed by left, top, width, height in percents
   * @access private
   * @return array array(x in px, y in px)
   */
  private function _translate($region) {
    return array(
      $this->width  * $region['left']   / 100.0,
      $this->height * $region['top']    / 100.0,
      $this->width  * $region['width']  / 100.0,
      $this->height * $region['height'] / 100.0
    );
  }

  /**
   * render
   *
   * Drops an image positioned to display the correct region.
   *
   * Options mixed in the following format:
   *   array region ( left, top, width, height )
   *         point  ( x, y )
   *         size   ( width, height )
   *
   * @param mixed $options See description
   * @access public
   * @return string Div with image positioned using hardcoded CSS (gross)
   */
  function render($options) {
    // if the map image failed to load, quit now
    if (!$this->width || !$this->height) { return false; }

    $options = array_merge(
      array(
        'region' => false,
        'point'  => false,
        'size'   => array(
          'width'  => $this->width  * 0.075,
          'height' => $this->height * 0.075,
        )
      ),
      $options
    );

    if (empty($options['region'])) {
      $this->log('minimap->render: empty location region');
      return;
    }

    // Because container is in pixels convert from percents
    list($posX, $posY, $dimX, $dimY) = $this->_translate($options['region']);

    // Zoom based on ratio of container to region dimension
    $zoomX = $this->width  / $dimX;
    $zoomY = $this->height / $dimY;

    // Use smaller zoom to ensure full map in sight
    $zoom = ($zoomX < $zoomY) ? $zoomX : $zoomY;

    // When zooming on one dimension, offset the other to centered focal point
    $offsetX = ($zoomX < $zoomY) ? 0 : ($zoomX - $zoomY) * $dimX / 2;
    $offsetY = ($zoomX > $zoomY) ? 0 : ($zoomY - $zoomX) * $dimY / 2;

    // Top left position taking into account offset
    $positionX = $posX - $offsetX / $zoom;
    $positionY = $posY - $offsetY / $zoom;

    // Get dimensions based on the final zoom
    $dimensionX = $this->width  / $zoom;
    $dimensionY = $this->height / $zoom;

    return $this->Html->div(
      'ui-location-map',
      $this->Html->image(
        $this->_path(
          floor($options['size']['width']),
          floor($options['size']['height']),
          floor($positionX),
          floor($positionY),
          floor($dimensionX),
          floor($dimensionY)
        )
      ),
      array(
        'style' => implode(';', array(
          'width:  ' . floor($options['size']['width'])  . 'px',
          'height: ' . floor($options['size']['height']) . 'px',
        ))
      )
    );
  }
}
