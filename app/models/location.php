<?php
class Location extends AppModel {

  var $name = 'Location';
  var $actsAs = array('Tree');
  var $order = 'Location.lft ASC';

  var $hasAndBelongsToMany = array('LocationTag');
  var $hasOne = array('CharacterLocation', 'LocationRegion', 'LocationPoint');

  public function afterSave()   { $this->clearCache(); }
  public function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('LocationGroupByRank');
  }

  /**
   * __findGroupByRank
   *
   * Obtain the locations keyed by rank
   *
   * @access protected
   * @return mixed array('Level ' . rank => array(location id => location name))
   */
  protected function __findGroupByRank() {
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

  /**
   * __findInfo
   *
   * Find Locations that are character locations. Result is not cached as there
   * are too many dependencies.
   *
   * @param mixed $options Array with character key if only for characters.
   * @access protected
   * @return mixed Location data
   */
  protected function __findInfo($options) {
    $this->bindModel(array('hasMany' => array('LocationsRace')));

    if (isset($options['characters'])) {
      $locations = $this->find('all', array(
        'conditions' =>
          array('id' => $this->CharacterLocation->find('location_ids'))
      ));
    } else {
      $locations = $this->find('all');
    }

    $ranks   = $this->CharacterLocation->find('ranks_by_location');
    $races   = $this->LocationsRace    ->find('race_by_location');
    $regions = $this->LocationRegion   ->find('location_region_by_location');

    $tags_by_location = $this->LocationTagsLocation->find('list', array(
      'fields' => array(
        'location_tag_id',
        'location_tag_id',
        'location_id',
      )
    ));
    $tags = Set::combine(
      $this->LocationTag->find('all'),
      '{n}.LocationTag.id',
      '{n}.LocationTag'
    );
    foreach ($tags_by_location as &$location) {
      foreach ($location as $key => &$tag) {
        $tag = $tags[$key];
      }
    }
    // TODO: location points

    foreach ($locations as &$l) {
      $id = $l['Location']['id'];
      $l['Rank']['id']     = (isset($ranks[$id]))   ? $ranks[$id]   : null;
      $l['Race']           = (isset($races[$id]))   ? $races[$id]   : null;
      $l['LocationRegion'] = (isset($regions[$id])) ? $regions[$id] : null;
      $l['LocationTag']    = (isset($tags_by_location[$id])) ? $tags_by_location[$id] : null;
    }

    return $locations;
  }

  protected function __findInfoForCharacters() {
    return $this->find('info', array('characters' => true));
  }

  public function afterFind($results, $primary) {
    if (!$primary && !Set::numeric(array_keys($results))) {
      if ( isset($results['LocationRegion'])
        && empty($results['LocationRegion'])
      ) {
        $location_ids = Set::extract(
          $this->getpath($results['id']),
          '{n}.Location.id'
        );
        $tree = Set::combine(
          $this->LocationRegion->find('all', array(
            'conditions' => array('location_id' => $location_ids)
          )),
          '{n}.LocationRegion.location_id',
          '{n}.LocationRegion'
        );

        // loop through all saving only the deepest match
        foreach ($location_ids as $location_id) {
          if (isset($tree[$location_id])) {
            $results['LocationRegion'] = $tree[$location_id];
          }
        }
      }
    }
    return $results;
  }
}
?>
