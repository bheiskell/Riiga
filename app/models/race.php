<?php
class Race extends AppModel {

  var $name = 'Race';
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('Rank');

  var $hasMany = array('LocationsRace', 'ProfessionsRace');

  var $hasOne = array('RaceAge');

  public function getGroupedByRank() {
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

    return $results;
  }
}
?>
