<?php
class Subrace extends AppModel {

  var $name = 'Subrace';
  var $validate = array(
    'name'        => array('notempty'),
    'description' => array('notempty'),
    'race_id'     => array('notempty'),
    'location_id' => array('notempty')
  );

  var $belongsTo = array('Race', 'Location');
  var $hasMany   = array('Character');

}
?>
