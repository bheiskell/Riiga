<?php
App::import('Vendor', 'Find.find_app_model');

class AppModel extends FindAppModel {
  var $actsAs = array('Containable', 'VerifyBelongsTo');
  var $recursive = -1;
}
