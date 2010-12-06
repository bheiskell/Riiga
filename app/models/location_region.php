<?php
class LocationRegion extends AppModel {

  var $name  = 'LocationRegion';
  var $order = array('LocationRegion.id' => 'ASC');
  var $belongsTo = array('Location');

  var $validate = array(
    'location_id'  => array(
      'rule'       => 'numeric',
      'required'   => true,
      'allowEmpty' => false
    ),
    'left'         => array(
      'rule'       => 'numeric',
      'required'   => true,
      'allowEmpty' => false
    ),
    'top'          => array(
      'rule'       => 'numeric',
      'required'   => true,
      'allowEmpty' => false
    ),
    'width'        => array(
      'rule'       => 'numeric',
      'required'   => true,
      'allowEmpty' => false
    ),
    'height'       => array(
      'rule'       => 'numeric',
      'required'   => true,
      'allowEmpty' => false
    ),
  );

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  function clearCache() {
    Cache::delete('LocationRegionLocationRegionByLocation');
  }

  /**
   * __findGroupedByLocation
   *
   * Return all location regions keyed by the location id
   *
   * @access protected
   * @return mixed array(location_id => array(top, left, width, height))
   */
  protected function __findLocationRegionByLocation() {
    $results = Cache::read('LocationRegionLocationRegionByLocation');

    if (false === $results) {
      $results = Set::combine(
        $this->find('all'),
        '{n}.LocationRegion.location_id',
        '{n}.LocationRegion'
      );
      Cache::write('LocationRegionLocationRegionByLocation', $results);
    }

    return $results;
  }
}
?>
