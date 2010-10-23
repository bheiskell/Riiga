<?php
class FactionRank extends AppModel {

  var $name = 'FactionRank';
  var $validate = array(
    'name' => array('notempty'),
    'age' => array('numeric')
  );

  var $belongsTo = array('Faction', 'Rank');

  public function getGroupedByFaction() {
    return Set::combine(
      $this->find('all', array('contain' => 'Faction')),
      '{n}.FactionRank.id',
      '{n}.FactionRank',
      '{n}.Faction.id'
    );
  }
}
?>
