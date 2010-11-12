<?php
class LocationsRace extends AppModel {

  var $name = 'LocationsRace';
  var $order = array('LocationsRace.id' => 'ASC');
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

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    Cache::delete('LocationsRaceGroupByRace');
  }

  /**
   * __findGroupByRace
   *
   * Obtain the location race information keyed by the location id
   *
   * @access public
   * @return mixed array(location id => array(race id => all info))
   */
  public function __findGroupByRace() {
    Cache::delete('LocationsRaceGroupByRace');
    $results = Cache::read('LocationsRaceGroupByRace');

    if (false === $results) {
      $this->contain('Race');
      $results = Set::combine(
        $this->find('all'),
        '{n}.LocationsRace.race_id',
        '{n}',
        '{n}.LocationsRace.location_id'
      );
      Cache::write('LocationsRaceGroupByRace', $results);
    }

    return $results;
  }

  /**
   * afterFind
   *
   * Translate likelihood from an int to a string to centralize the conversion.
   * This value isn't used programatically anywhere.
   *
   * I didn't have enums avaliable so likelihood is an integer instead.
   * 0 means common and 1 means possible. There is no entry for unlikely.
   *
   * @param mixed $results Results from find
   * @access public
   * @return mixed Results from find with likelihood translated
   */
  public function afterFind($results) {
    foreach ($results as $key => &$result) {
      if (isset($result['LocationsRace']['likelihood'])) {
        switch ($result['LocationsRace']['likelihood']) {
          case 0: $result['LocationsRace']['likelihood'] = 'Common';   break;
          case 1: $result['LocationsRace']['likelihood'] = 'Uncommon'; break;
          default:
            $this->log('LocationsRace likelihood contains an unexpected value');
            $this->cakeError('error404');
        }
      }
    }
    return $results;
  }
}
?>
