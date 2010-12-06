<?php
class Profession extends AppModel {

  var $name = 'Profession';
  var $order = array('UPPER(Profession.name)' => 'ASC');
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('ProfessionCategory');
  var $hasMany = array('ProfessionsRace');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('ProfessionGroupByCategory');
  }

  /**
   * __findGroupByCategory
   *
   * Obtain profession information keyed by the category name
   *
   * @access public
   * @return mixed array(category => array(profession))
   */
  protected function __findGroupByCategory() {
    $results = Cache::read('ProfessionGroupByCategory');

    if (false === $results) {
      $results = Set::combine(
        $this->find('all', array(
          'contain' => array('ProfessionCategory')
        )),
        '{n}.Profession.id',
        '{n}',
        '{n}.ProfessionCategory.name'
      );
      Cache::write('ProfessionGroupByCategory', $results);
    }

    return $results;
  }
}
?>
