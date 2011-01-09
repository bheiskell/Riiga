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
    Cache::delete('FactionRankGroupByFactionName');
  }

  /**
   * isFactionRankInFaction
   *
   * Determin if a faction rank is a member of a particular faction
   *
   * @param mixed $faction_id
   * @param mixed $faction_rank_id
   * @access public
   * @return boolean True on membership
   */
  public function isFactionRankInFaction($faction_id, $faction_rank_id) {
    return $this->find('count', array(
      'conditions' => array(
        'id'         => $faction_rank_id,
        'faction_id' => $faction_id,
      ),
    ));
  }

  /**
   * checkFactionRankAge
   *
   * Confirm an age is old enough for this rank.
   *
   * @param mixed $id
   * @param mixed $age
   * @access public
   * @return boolean True if the old enough
   */
  public function checkFactionRankAge($id, $age) {
    $this->id = $id;
    $faction_rank_age = $this->field('age');

    // Check isn't possible
    if (!is_numeric($age)) { return true; }

    return $faction_rank_age <= $age;
  }

  /**
   * checkFactionRankLevel
   *
   * Confirm that a level is high enough for this rank
   *
   * @param mixed $id
   * @param mixed $level
   * @access public
   * @return boolean True on check confirmed
   */
  public function checkFactionRankLevel($id, $level) {
    $this->id = $id;
    $faction_rank_level = $this->field('rank_id');

    return $faction_rank_level <= $level;
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

  /**
   * __findGroupByFactionName
   *
   * Obtain list format of faction ranks grouped on the faction name
   *
   * @access protected
   * @return mixed 'list' format grouped by the faction name
   */
  protected function __findGroupByFactionName() {
    $results = Cache::read('FactionRankGroupByFactionName');

    if (false === $results) {
      $results = Set::combine(
        $this->find('all', array('contain' => 'Faction')),
        '{n}.FactionRank.id',
        '{n}.FactionRank.name',
        '{n}.Faction.name'
      );
      Cache::write('FactionRankGroupByFactionName', $results);
    }

    return $results;
  }
}
?>
