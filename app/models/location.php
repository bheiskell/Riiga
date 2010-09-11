<?php
class Location extends AppModel {

  var $name = 'Location';
  var $actsAs = array('Tree');
  var $order = 'Location.lft ASC';

  var $hasAndBelongsToMany = array('LocationTags');
  var $hasOne = array('CharacterLocations');

  public function getGroupedByRank() {
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
        'order' => array('rank_id'),
      )
    );

    /* Need a prefix to the grouping */
    foreach(array_keys($results) as $key) {
      $results["Level {$key}"] = $results[$key];
      unset($results[$key]);
    }

    return $results;
  }
}
?>
