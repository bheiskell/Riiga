<?php
class LocationPoint extends AppModel {

  var $name = 'LocationPoint';
  var $order = array('LocationPoint.id' => 'ASC');
  var $validate = array(
    'location_id' => array('numeric'),
    'x' => array('numeric'),
    'y' => array('numeric')
  );

  var $belongsTo = array('Location');
}
?>
