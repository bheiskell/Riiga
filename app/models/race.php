<?php
class Race extends AppModel {

  var $name = 'Race';
  var $order = array('Race.id' => 'ASC');
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('Rank');

  var $hasMany = array('LocationsRace', 'ProfessionsRace');

  var $hasOne = array('RaceAge');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('RaceGroupByRank');
    Cache::delete('FactionGroupByRace');
    Cache::delete('LocationsRaceGroupByRace');
  }

  /**
   * __findGroupByRank
   *
   * Find race keyed by the rank in the format 'Level ##'
   *
   * @access public
   * @return mixed array('Level ' . rank => array(race id => race name))
   */
  public function __findGroupByRank() {
    $results = Cache::read('RaceGroupByRank');

    if (false === $results) {
      $results = $this->find('list',
        array(
          'fields' => array('id', 'name', 'rank_id'),
          'order'  => array('rank_id, id asc'),
        )
      );

      /* Need a prefix to the grouping */
      foreach(array_keys($results) as $key) {
        $results["Level {$key}"] = $results[$key];
        unset($results[$key]);
      }

      Cache::write('RaceGroupByRank', $results);
    }

    return $results;
  }
}
?>
