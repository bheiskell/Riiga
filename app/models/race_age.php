<?php
class RaceAge extends AppModel {
  var $name      = 'RaceAge';
  var $order     = array('RaceAge.id' => 'ASC');
  var $belongsTo = array('Race');
  var $validate  = array(
    'child'  => array('numeric'),
    'teen'   => array('numeric'),
    'adult'  => array('numeric'),
    'mature' => array('numeric'),
    'elder'  => array('numeric'),
    'max'    => array('numeric'),
  );
}
?>
