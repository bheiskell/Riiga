<?php
App::import('Vendor', 'Find.find_app_model');

//class AppModel extends FindAppModel {
class AppModel extends Model {
  var $actsAs = array('Containable');
  var $recursive = -1;

  // TODO: Implement http://github.com/mcurry/find/ as it will make dealing
  // with find overloading much nicer. Found in "Super Awesome Advanced CakePHP
  // Tips" by Matt Curry
}
?>
