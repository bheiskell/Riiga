<?php
class CharacterLocation extends AppModel {

  var $name  = 'CharacterLocation';
  var $order = array('CharacterLocation.id' => 'ASC');

  var $belongsTo = array('Location', 'Rank');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('CharacterLocationLocationIds');
    Cache::delete('CharacterLocationRanks');
  }

  /**
   * __findLocationIds
   *
   * Array of all locations
   *
   * @access public
   * @return mixed array(id => location_id)
   */
  public function __findLocationIds() {
    $results = Cache::read('CharacterLocationLocationIds');

    if (false === $results) {
      $results = $this->find('list', array(
        'fields' => array('id', 'location_id')
      ));
      Cache::write('CharacterLocationLocationIds', $results);
    }

    return $results;
  }

  /**
   * __findRanks
   *
   * Array of ranks keyed by location
   *
   * @access public
   * @return mixed array(location_id => rank_id)
   */
  public function __findRanks() {
    $results = Cache::read('CharacterLocationRanks');

    if (false === $results) {
      $results = $this->find('list', array(
        'fields' => array('location_id', 'rank_id')
      ));
      Cache::write('CharacterLocationRanks', $results);
    }

    return $results;
  }

  /**
   * __findLocations
   *
   * Find Locations that are character locations. Result is not cached as it
   * would create a cache dependency on Location.
   *
   * @access public
   * @return mixed Location data
   */
  public function __findLocations() {
    return $this->Location->find('all', array(
      'conditions' => array('id' => $this->find('location_ids'))
    ));
  }
}
?>
