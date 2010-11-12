<?php
class Location extends AppModel {

  var $name = 'Location';
  var $actsAs = array('Tree');
  var $order = 'Location.lft ASC';

  var $hasAndBelongsToMany = array('LocationTag');
  var $hasOne = array('CharacterLocation', 'LocationRegion');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('LocationGroupByRank');
  }

  public function __findGroupByRank() {
    $results = Cache::read('LocationGroupByRank');

    if (false === $results) {
      $results = $this->find('list',
        array(
          'joins' => array(
            array(
              'table' => 'character_locations',
              'alias' => 'CharacterLocation',
              'type' => 'INNER',
              'conditions' =>
                array('Location.id = CharacterLocation.location_id')
            )
          ),
          'fields' => array('id', 'name', 'CharacterLocation.rank_id'),
          'order' => array('rank_id', 'Location.lft'),
        )
      );

      /* Need a prefix to the grouping */
      foreach(array_keys($results) as $key) {
        $results["Level {$key}"] = $results[$key];
        unset($results[$key]);
      }

      Cache::write('LocationGroupByRank', $results);
    }

    return $results;
  }
}
?>
