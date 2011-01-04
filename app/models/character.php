<?php
class Character extends AppModel {

  var $name   = 'Character';
  var $actsAs = array('Pending');
  var $order  = array('UPPER(Character.name)' => 'ASC');

  var $hasAndBelongsToMany = array(
    'Story' => array('with' => 'CharactersStory')
  );

  var $belongsTo = array(
    'Faction',
    'Location',
    'Race',
    'Rank',
    'User',
  );

  var $validate = array(
    'user_rank' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('checkLimit'),
      'message'      => 'Authors are allocated one character per rank.',
    ),
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
        //'required'     => true,
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

  /**
   * isOwner
   *
   * Confirm the user owns the specified character
   *
   * @param mixed $character_id
   * @param mixed $user_id
   * @access public
   * @return boolean True if ownership
   */
  public function isOwner($id, $user_id) {
    return 1 == $this->find('count', array(
      'conditions' => compact('id', 'user_id')
    ));
  }

  /**
   * getUserIdById
   *
   * Obtain the user_id of a given character
   *
   * @param mixed $id
   * @access public
   * @return int Id of the user
   */
  public function getUserIdById($id) {
    return $this->field('user_id', compact('id'));
  }

  /**
   * checkLimit
   *
   * Ensure a user hasn't created more characters than they're allowed. Users
   * are allocated one character per rank until they reach level 7.
   *
   * @access private
   * @return boolean True on successful validate.
   */
  private function checkLimit() {
    if ($this->data['Character']['id']) { return true; }

    $user_id = $this->data['Character']['user_id'];
    $rank = $this->User->getRank($user_id);

    // Rank zero is a special case for new characters. Seven is max rank.
    if (0 === $rank) { $rank = 1; }
    if (7 === $rank) { return true; }

    return $rank > $this->find('count', array(
      'conditions' => array('user_id' => $user_id)
    ));
  }

  /**
   * checkRank
   *
   * The character rank cannot exceed the user's rank.
   *
   * @param mixed $check array('key' => 'value')
   * @access private
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  private function checkRank($check) {
    $key   = array_shift(array_keys($check));
    $value = array_shift(array_values($check));

    $userRank = $this->User->getRank($this->data['Character']['user_id']);

    // New users need to be able to register a character
    if (0 === $userRank) $userRank = 1;

    if ($userRank < $value) {
      $this->invalidate($key, sprintf(
        __('The character level cannot exceed your rank (%d)', true), $userRank
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
   * @access private
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  private function limitByRank($check, $model) {
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
        'Your character is not a high enough level (%d) for this option', true
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
   * @access private
   * @return boolean Always true, because on failure a custom invalidate is
   *                 called with a dynamic message explaining the failure.
   */
  private function checkFaction($check) {
    $key   = array_shift(array_keys($check));
    $value = array_shift(array_values($check));

    if (!$value) { return true; }

    $this->Faction->contain('Race');
    $data = $this->Faction->findById($value);

    $path = sprintf('/Race[id=%d]', $this->data['Character']['race_id']);
    $data = Set::extract($path, $data);

    if (empty($data)) {
      $this->invalidate($key, __(
        'This faction does not accept members of the specified race.', true
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

  /**
   * __findAvailable
   *
   * Get a list of characters that are not currently in a story.
   *
   * @param mixed $user_id Character's owner
   * @access protected
   * @return array Results in the find('list') format
   */
  protected function __findAvailable($user_id) {
    $this->bindModel(array('hasOne' => array('CharactersStory')));
    $this->contain('CharactersStory');

    return Set::combine(
      $this->find('all', array(
        'fields' => array('id', 'name'),
        'conditions' => array(
          'Character.user_id' => $user_id,
          'OR' => array(
            'CharactersStory.is_deactivated = 1',
            'CharactersStory.is_deactivated IS NOT NULL',
          )
        )
      )),
      '{n}.Character.id',
      '{n}.Character.name'
    );
  }

  /**
   * __findListByStoryAndUser
   *
   * Get a character list by story and user.
   *
   * @param mixed $options Array keyed by story_id and user_id
   * @access protected
   * @return array Array of character names keyed my character id
   */
  protected function __findListByStoryAndUser($options) {
    $options =
      array_merge(array('story_id' => false, 'user_id' => false), $options);

    $character_ids = Set::extract(
      '/CharactersStory/character_id',
      $this->CharactersStory->findAllByStoryId($options['story_id'])
    );

    return Set::combine(
      $this->find('all', array(
        'conditions' => array(
          'id'      => $character_ids,
          'user_id' => $options['user_id'],
        )
      )),
      '{n}.Character.id',
      '{n}.Character.name'
    );
  }

  /**
   * __findAllByStoryId
   *
   * Find all characters by their story id. Be sure to include the
   * CharactersStory data that specifies whether the character has been removed
   * from the story.
   *
   * @param mixed $story_id
   * @access protected
   * @return array
   */
  protected function __findAllByStoryId($story_id) {
    $characters = $this->CharactersStory->find('all', array(
      'conditions'  => array('story_id' => $story_id),
      'contain'     => array('Character'),
      'deactivated' => true,
    ));

    return $characters;
  }
}
?>
