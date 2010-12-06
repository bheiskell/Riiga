<?php
class Faction extends AppModel {

  var $name     = 'Faction';
  var $order    = array('Faction.id' => 'ASC');
  var $validate = array(
    'name' => array('notempty')
  );

  var $hasAndBelongsToMany = array('Race');
  var $hasMany             = array('FactionRank');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('FactionGroupByRace');
    Cache::delete('FactionRankGroupByFaction');
  }

  /**
   * __findGroupByRace
   *
   * Obtain faction / race data keyed by the race name
   *
   * @access protected
   * @return mixed array(race => array(faction id => faction name)
   */
  protected function __findGroupByRace() {
    $results = Cache::read('FactionGroupByRace');

    if (false === $results) {
      $results = $this->find('list',
        array(
          'joins' => array(
            array(
              'table' => 'factions_races',
              'alias' => 'FactionsRace',
              'type' => 'INNER',
              'conditions' => array('Faction.id = FactionsRace.faction_id')
            ),
            array(
              'table' => 'races',
              'alias' => 'Race',
              'type' => 'INNER',
              'conditions' => array('Race.id = FactionsRace.race_id')
            ),
          ),
          'fields' => array('id', 'name', 'Race.name'),
          'order' => array('Faction.id'),
        )
      );
      Cache::write('FactionGroupByRace', $results);
    }

    return $results;
  }
}
?>
