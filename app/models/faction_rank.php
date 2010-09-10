<?php
class FactionRank extends AppModel {

  var $name = 'FactionRank';
  var $validate = array(
    'name' => array('notempty'),
    'age' => array('numeric')
  );

  var $belongsTo = array('Faction', 'Rank');
}
?>
