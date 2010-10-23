<?php
class LocationTag extends AppModel {

  var $name = 'LocationTag';
  var $order = array('UPPER(LocationTag.name)' => 'ASC');

  var $hasAndBelongsToMany = array('Location');

}
?>
