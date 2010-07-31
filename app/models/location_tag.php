<?php
class LocationTag extends AppModel {

  var $name = 'LocationTag';

  var $hasAndBelongsToMany = array('Location');

}
?>
