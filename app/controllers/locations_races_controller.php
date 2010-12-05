<?php
class LocationsRacesController extends AppController {
  var $name = 'LocationsRaces';
  var $scaffold = 'admin';

  function beforeFilter() {
    parent::beforeFilter();

    // The CharacterLocation binding screws up the admin index page
    if ('admin_index' == $this->action) {
      $this->LocationsRace->unbindModel(array(
        'belongsTo' => array('CharacterLocation')
      ), true);
    }
  }
}
