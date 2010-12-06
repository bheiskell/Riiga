<?php
class FactionRank extends AppModel {

  var $name = 'FactionRank';
  var $order = array('FactionRank.id' => 'ASC');
  var $validate = array(
    'name' => array('notempty'),
    'age' => array('numeric')
  );

  var $belongsTo = array('Faction', 'Rank');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('FactionRankGroupByFaction');
  }

  /**
   * __findGroupByFaction
   *
   * Obtain faction ranks keyed by the faction id
   *
   * @access protected
   * @return mixed array(faction id => array(faction ranks))
   */
  protected function __findGroupByFaction() {
    $results = Cache::read('FactionRankGroupByFaction');

    if (false === $results) {
      $results = Set::combine(
        $this->find('all', array('contain' => 'Faction')),
        '{n}.FactionRank.id',
        '{n}.FactionRank',
        '{n}.Faction.id'
      );
      Cache::write('FactionRankGroupByFaction', $results);
    }

    return $results;
  }
}
?>
