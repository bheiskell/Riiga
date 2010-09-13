<?php
class Profession extends AppModel {

  var $name = 'Profession';
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('ProfessionCategory');
  var $hasMany = array('ProfessionsRace');

  // Need profession category as well
  // Group by category
  public function getGroupedByCategory() {
    return Set::combine(
      $this->find('all'),
      '{n}.Profession.id',
      '{n}',
      '{n}.ProfessionCategory.name'
    );
  }
}
?>
