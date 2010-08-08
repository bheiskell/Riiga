<?php
class Race extends AppModel {

  var $name = 'Race';
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('Rank');
}
?>
