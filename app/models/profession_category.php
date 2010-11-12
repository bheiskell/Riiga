<?php
class ProfessionCategory extends AppModel {

  var $name     = 'ProfessionCategory';
  var $order    = array('UPPER(ProfessionCategory.name)' => 'ASC');
  var $hasMany  = array('Profession');
  var $validate = array('name' => array('notempty'));

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('ProfessionGroupByCategory');
  }
}
?>
