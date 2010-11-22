<?php
class CharacterLocation extends AppModel {

  var $name  = 'CharacterLocation';
  var $order = array('CharacterLocation.id' => 'ASC');

  var $belongsTo = array('Location', 'Rank');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('CharacterLocationLocationIds');
    Cache::delete('CharacterLocationRanksByLocation');
    Cache::delete('LocationGroupByRank');
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
  public function __findRanksByLocation() {
    $results = Cache::read('CharacterLocationRanksByLocation');

    if (false === $results) {
      $results = $this->find('list', array(
        'fields' => array('location_id', 'rank_id')
      ));
      Cache::write('CharacterLocationRanksByLocation', $results);
    }

    return $results;
  }
}
?>
