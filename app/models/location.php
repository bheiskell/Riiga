<?php
class Location extends AppModel {

  var $name = 'Location';
  var $actsAs = array('Tree');
  var $order = 'Location.lft ASC';

  var $hasAndBelongsToMany = array('LocationTags');
}
?>
