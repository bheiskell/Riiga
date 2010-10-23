<?php
class ProfessionsRace extends AppModel {

  var $name = 'ProfessionsRace';
  var $order = array('ProfessionsRace.id' => 'ASC');
  var $validate = array(
    'age' => array('numeric')
  );

  var $belongsTo = array('Profession', 'Race');
}
?>
