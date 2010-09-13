<?php
class ProfessionsRace extends AppModel {

  var $name = 'ProfessionsRace';
  var $validate = array(
    'age' => array('numeric')
  );

  var $belongsTo = array('Profession', 'Race');
}
?>
