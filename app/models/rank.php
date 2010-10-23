<?php
class Rank extends AppModel {

  var $name = 'Rank';
  var $order = array('Rank.id' => 'ASC');
  var $validate = array(
    'name' => array('notempty'),
    'entry_count' => array('numeric')
  );

}
?>
