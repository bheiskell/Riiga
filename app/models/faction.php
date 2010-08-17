<?php
class Faction extends AppModel {

  var $name = 'Faction';
  var $validate = array(
    'name' => array('notempty')
  );

  var $hasAndBelongsToMany = array('Race');

  var $hasMany = array('FactionRank');

  /* Overloading find to offer grouped results to the controller */
  public function find(
    $conditions = NULL, $fields = array(), $order = NULL, $recursive = NULL
  ) {
    if ('grouped' == $conditions) {
      return $this->find('list',
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
        )
      );
    } else {
      return parent::find($conditions, $fields, $order, $recursive);
    }
  }
}
?>
