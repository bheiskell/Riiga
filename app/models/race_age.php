<?php
class RaceAge extends AppModel {

  var $name = 'RaceAge';
  var $validate = array(
    'child' => array('numeric'),
    'teen' => array('numeric'),
    'adult' => array('numeric'),
    'mature' => array('numeric'),
    'elder' => array('numeric'),
    'max' => array('numeric')
  );

  var $belongsTo = array('Race');

  /* Overloading find to offer table results to the controller */
  public function find(
    $conditions = NULL, $fields = array(), $order = NULL, $recursive = NULL
  ) {
    if ('table' == $conditions) {
      $raceAges = $this->find('all');

      $race = array();
      foreach ($raceAges as $raceAge) {
        $race[$raceAge['Race']['name']] = $raceAge['RaceAge'];
      }

     return $race;
    } else {
      return parent::find($conditions, $fields, $order, $recursive);
    }
  }
}
?>
