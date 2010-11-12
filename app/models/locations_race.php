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

  // HACK: I didn't have enums avaliable so likelihood is an integer instead.
  // 0 means common and 1 means possible. There is no entry for unlikely.
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
