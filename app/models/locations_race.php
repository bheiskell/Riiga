<?php
class LocationsRace extends AppModel {

  var $name = 'LocationsRace';
  var $validate = array(
    'likelihood' => array('numeric')
  );

  var $belongsTo = array(
    'Location',
    'Race',
    'CharacterLocation' => array(
      'className' => 'CharacterLocation',
      'foreignKey' => 'location_id',
    )
  );

  /* Overloading find to offer table results to the controller */
  public function find(
    $conditions = NULL, $fields = array(), $order = NULL, $recursive = NULL
  ) {
    if ('table' == $conditions) {
      return $this->find('list', array(
        'joins' => array(
          array(
            'table' => 'locations',
            'alias' => 'Location',
            'type' => 'INNER',
            'conditions' => array('LocationsRace.location_id = Location.id')
          ),
          array(
            'table' => 'races',
            'alias' => 'Race',
            'type' => 'INNER',
            'conditions' => array('LocationsRace.race_id = Race.id')
          ),
        ),
        'fields' => array('Location.name', 'likelihood', 'Race.name'),
      ));
    } else {
      return parent::find($conditions, $fields, $order, $recursive);
    }
  }
}
?>
