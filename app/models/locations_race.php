<?php
class LocationsRace extends AppModel {

  var $name = 'LocationsRace';
  var $validate = array(
    'likelihood' => array('numeric')
  );

  var $belongsTo = array(
    'Location',
    'Race',
    'CharacterLocation' => array(
      'className' => 'CharacterLocation',
      'foreignKey' => 'location_id',
    )
  );

  public function getGroupedByRace() {
    return Set::combine(
      $this->find('all'),
      '{n}.Location.id',
      '{n}',
      '{n}.Race.id'
    );
  }
}
?>
