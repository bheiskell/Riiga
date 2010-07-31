<?php
class Location extends AppModel {

  var $name = 'Location';
  var $actsAs = array('Tree');

  var $hasAndBelongsToMany = array('LocationTags');
}
?>
