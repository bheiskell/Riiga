<?php
class FactionRank extends AppModel {

  var $name = 'FactionRank';
  var $validate = array(
    'name' => array('notempty'),
    'age' => array('numeric')
  );

  var $belongsTo = array('Faction', 'Rank');

  /* Overloading find to offer table results to the controller */
  public function find(
    $conditions = NULL, $fields = array(), $order = NULL, $recursive = NULL
  ) {
    if ('table' == $conditions) {
      $joins = array(array(
        'table' => 'factions',
        'alias' => 'Faction',
        'type' => 'INNER',
        'conditions' => array('Faction.id = FactionRank.faction_id')
      ));
      $names = $this->find('list', array(
        'joins' => $joins,
        'fields' => array('id', 'name', 'Faction.name'),
        'order' => array('rank_id', 'age'),
      ));
      $rankIds = $this->find('list', array(
        'joins' => $joins,
        'fields' => array('id', 'rank_id', 'Faction.name'),
      ));
      $ages = $this->find('list', array(
        'joins' => $joins,
        'fields' => array('id', 'age', 'Faction.name'),
      ));

      $results = array();
      foreach (array_keys($names) as $faction) {
        $results[$faction] = array();
        foreach (array_keys($names[$faction]) as $factionRankId) {
          $results[$faction][$factionRankId] = array(
            'name'    => $names[$faction][$factionRankId],
            'rank_id' => $rankIds[$faction][$factionRankId],
            'age'     => $ages[$faction][$factionRankId],
          );
        }
      }

      return $results;
    } else {
      return parent::find($conditions, $fields, $order, $recursive);
    }
  }
}
?>
