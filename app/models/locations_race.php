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
}
?>
