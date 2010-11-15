<?php
class Character extends AppModel {

  var $name   = 'Character';
  var $actsAs = array('Pending');
  var $order  = array('UPPER(Character.name)' => 'ASC');

  var $hasAndBelongsToMany = array('Story');

  var $belongsTo = array(
    'Faction',
    'Location',
    'Race',
    'Rank',
    'User',
  );

  var $validate = array(
    'user_id' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('comparison', '>=', 0),
      'message'      => 'Invalid Member'
    ),
    'name' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Name must be between one and 256 characters.'
    ),
    'rank_id' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('checkRank'),
    ),
    'race_id' => array(
      'limitByRank' => array('rule' => array('limitByRank', 'Race')),
      'numeric' => array (
        'required'     => true,
        'allowEmpty'   => false,
        'rule'         => array('numeric'),
        'message'      => "Specify the character's race."
      ),
    ),
    'location_id' => array(
      'limitByRank' => array('rule' => array('limitByRank', 'Location')),
      'numeric' => array (
        'required'     => true,
        'allowEmpty'   => false,
        'rule'         => array('numeric'),
        'message'      => "Specify the character's residency.",
      ),
    ),
    'faction_id' => array(
      'checkFaction' => array('rule' => array('checkFaction')),
      'numeric' => array (
        'required'     => true,
        'allowEmpty'   => true,
        'rule'         => array('numeric'),
        'message'      => "Faction ID must be numeric.",
      ),
    ),
    'description' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'Description must be between one and 4096 characters.'
    ),
    'age' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Age must be between one and 256 characters.'
    ),
    'profession' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Profession must be between one and 256 characters.'
    ),
    'history' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'History must be between one and 4096 characters.'
    ),
    'avatar' => array(
      'maxlength' => array(
        'rule'       => array('maxlength', 1024),
        'message'    => 'Avatar must be less than 1024 characters.'
      ),
      'url' => array(
        'rule'       => 'url',
        'allowEmpty' => true,
        'message'    => 'Avatar must be a valid URL.'
      )
    ),
  );

  // TODO: Need character creation limit

  /**
   * checkRank
   *
   * The character rank cannot exceed the user's rank.
   *
   * @param mixed $check array('key' => 'value')
   * @access public
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  function checkRank($check) {
    $key   = array_shift(array_keys($check));
    $value = array_shift(array_values($check));

    $userRank = $this->User->findRankById($this->data['Character']['user_id']);

    if (0 !== $userRank && $userRank < $value) {
      $this->invalidate($key, sprintf(
        __("The character level cannot exceed your rank (%d)", true), $userRank
      ));
    }

    return true;
  }

  /**
   * limitByRank
   *
   * Check that the field doesn't exceed the character's rank.
   *
   * @param mixed $check array('key' => 'value')
   * @access public
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  function limitByRank($check, $model) {
    $key   = array_shift(array_keys($check));
    $value = array_shift(array_values($check));

    switch ($model) {
      case 'Location':
        $this->{$model}->CharacterLocation->contain('Rank');
        $data = $this->{$model}->CharacterLocation->findByLocationId($value);
        break;
      case 'Race':
        $this->{$model}->contain('Rank');
        $data = $this->{$model}->findById($value);
        break;
      default: return false;
    }

    if (empty($data) || !isset($data['Rank']['id'])) { return false; }

    $rank = $data['Rank']['id'];

    if ($rank > $this->data['Character']['rank_id']) {
      $this->invalidate($key, sprintf(__(
        "Your character is not a high enough level (%d) for this option", true
      ), $rank));
    }

    return true;
  }

  /**
   * checkFaction
   *
   * Verify the numerous rules for factions. This whole block feels hack.
   *
   * @param mixed $check array('key' => 'value')
   * @access public
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  function checkFaction($check) {
    $key   = array_shift(array_keys($check));
    $value = array_shift(array_values($check));

    if (!$value) { return true; }

    $this->Faction->contain('Race');
    $data = $this->Faction->findById($value);

    $path = sprintf('/Race[id=%d]', $this->data['Character']['race_id']);
    $data = Set::extract($path, $data);

    if (empty($data)) {
      $this->invalidate($key, __(
        "This faction doesn't accept members of your character's race.", true
      ));
      return true;
    }

    $data = $this->Faction->FactionRank->find('all', array(
      'conditions' => array(
        'faction_id  =' => $this->data['Character']['faction_id'],
        'rank_id    <=' => $this->data['Character']['rank_id'],
      )
    ));

    if (empty($data)) {
      $this->invalidate($key, __(
        'Your character is not a high enough rank to join this faction.', true
      ));
      return true;
    }

    if (is_numeric($this->data['Character']['age'])) {
      $path = sprintf('/FactionRank[age<=%d]', $this->data['Character']['age']);
      $data = Set::extract($path, $data);

      if (empty($data)) {
        $this->invalidate($key, __(
          'Your character is not old enough to join this faction.', true
        ));
        return true;
      }
    }

    return true;
  }
}
?>
