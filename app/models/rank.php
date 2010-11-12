<?php
class Rank extends AppModel {

  var $name = 'Rank';
  var $order = array('Rank.id' => 'ASC');
  var $validate = array(
    'name' => array('notempty'),
    'entry_count' => array('numeric')
  );

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('RaceGroupByRank');
    Cache::delete('LocationGroupByRank');
  }
}
?>
