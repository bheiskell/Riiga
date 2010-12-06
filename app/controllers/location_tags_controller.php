<?php
class LocationTagsController extends AppController {
  var $name = 'LocationTags';
  var $scaffold = 'admin';

  function beforeFilter() {
    parent::beforeFilter();

    // Edit page needs to contain the locations in the HABTM relation
    if ('admin_edit' == $this->action) {
      $this->LocationTag->contain('Location');
    }
  }
}
