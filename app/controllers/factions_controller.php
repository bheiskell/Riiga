<?php
class FactionsController extends AppController {
  var $name = 'Factions';
  var $scaffold = 'admin';

  function beforeFilter() {
    parent::beforeFilter();

    // Edit page needs to contain the races in the HABTM relation
    if ('admin_edit' == $this->action) {
      $this->Faction->contain('Race');
    }
  }
}
