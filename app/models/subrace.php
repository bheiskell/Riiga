<?php
class Subrace extends AppModel {

  var $name = 'Subrace';
  var $validate = array(
    'name'        => array('notempty'),
    'description' => array('notempty'),
    'race_id'     => array('notempty'),
    'location_id' => array('notempty')
  );

  var $belongsTo = array('Race', 'Location');
  var $hasMany   = array('Character');

  /**
   * __findGroupByRace
   *
   * Find subrace keyed by the race
   *
   * @access protected
   * @return mixed Subrace ids and descriptions grouped by race
   */
  protected function __findGroupByRace() {
    return Set::combine(
      $this->find('all',
        array(
          'order'   => array('Race.id, Subrace.id asc'),
          'contain' => array('Race'),
        )
      ),
      '{n}.Subrace.id',
      '{n}.Subrace.name',
      '{n}.Race.name'
    );
  }
}
?>
