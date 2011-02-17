<?php
class Story extends AppModel {

  var $name  = 'Story';
  var $order = array('Story.id' => 'DESC');

  var $hasMany             = array('Entry');
  var $hasAndBelongsToMany = array(
    'Character' => array('with' => 'CharactersStory'),
    'User'      => array('with' => 'StoriesUser'),
  );
  var $belongsTo = array(
    'Location',
    'Turn'         => array(
      'className'  => 'User',
      'foreignKey' => 'user_id_turn',
    )
  );
  var $hasOne = array(
    'LatestEntry' => array(
      'className' => 'Entry',
      'foreignKey' => false,
      'fields' => array('id', 'user_id', 'created'),
      'conditions' => array(
        'LatestEntry.story_id = Story.id',
        'LatestEntry.id = (SELECT MAX(id) FROM entries WHERE Story.id = entries.story_id)'
      ),
    ),
  );

  var $actsAs = array('Sluggable' => array(
    'label'     => 'name',
    'separator' => '_',
    'overwrite' => true,
    'ignore'    => array(),
  ));

  var $validate = array(
    'id' => array(
      'required'     => false,
      'allowEmpty'   => true,
      'rule'         => array('numeric'),
      'message'      => 'Invalid Story Id'
    ),
    'location_id' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('numeric'),
      'message'      => 'Invalid Location'
    ),
    'turn_id' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('numeric'),
      'message'      => 'Invalid Member'
    ),
    'user_id' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('numeric'),
      'message'      => 'Invalid Member'
    ),
  );

  /**
   * isMember
   *
   * Determine if a user is a member a story
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on membership
   */
  public function isMember($story_id, $user_id) {
    return (1 == $this->StoriesUser->find('count', array(
      'conditions' => array('story_id' => $story_id, 'user_id'  => $user_id)
    )));
  }

  /**
   * getNameById
   *
   * Get story name
   *
   * @param mixed $story_id
   * @access public
   * @return string Name of the story
   */
  public function getNameById($story_id) {
    return $this->field('name', array('id' => $story_id));
  }

  /**
   * rotateTurn
   *
   * Rotate the user's turns
   *
   * @param mixed $story_id 
   * @param mixed $turn_id 
   * @access public
   * @return void
   */
  public function rotateTurn($story_id, $turn_id) {
    // Hack: this code feels like garbage. Make this better.
    $user_ids = Set::extract(
      '/StoriesUser/user_id',
      $this->StoriesUser->findAllByStoryId($story_id)
    );
    $position = null;
    foreach ($user_ids as $key => $user_id) {
      if ($user_id === $turn_id) {
        $position = $key;
      }
    }
    if ($position === null) return false;
    $new_id = $user_ids[($position + 1) % sizeof($user_ids)];
    $this->id = $story_id;
    $this->saveField('user_id_turn', $new_id);
  }

  /**
   * isModerator
   *
   * Determine if a user is a story moderator. Does not perform an isAdmin check
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on moderator status
   */
  public function isModerator($story_id, $user_id) {
    return $this->StoriesUser->isModerator($story_id, $user_id);
  }

  /**
   * addCharacter
   *
   * Add a character from a story.
   *
   * @param mixed $story_id
   * @param mixed $character_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on success
   */
  public function addCharacter($story_id, $character_id, $user_id) {
    if (!$this->Character->isOwner($character_id, $user_id)) {
      return false;
    }

    return $this->CharactersStory->add($story_id, $character_id);
  }

  /**
   * removeCharacter
   *
   * Remove a character from a story.
   *
   * @param mixed $story_id
   * @param mixed $character_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on success
   */
  public function removeCharacter($story_id, $character_id, $user_id = false) {
    // Don't peform the check if a moderator requested the removal
    if ($user_id && !$this->Character->isOwner($character_id, $user_id)) {
      return false;
    }

    return $this->CharactersStory->remove($story_id, $character_id);
  }

  /**
   * removeAllCharacters
   *
   * Remove all characters from a story, effectively leaving the story.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on success
   */
  public function removeAllCharacters($story_id, $user_id) {
    return $this->CharactersStory->removeAll($story_id, $user_id);
  }

  /**
   * promote
   *
   * Promote a user to moderator status for a particular story.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on successful promotion
   */
  public function promote($story_id, $user_id) {
    return $this->StoriesUser->add($story_id, $user_id, true);
  }

  /**
   * demote
   *
   * Demote a user from the moderator status for a particular story
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on successful demotion
   */
  public function demote($story_id, $user_id) {
    return $this->StoriesUser->add($story_id, $user_id, false);
  }

  /**
   * close
   *
   * Close a story
   *
   * @param mixed $story_id 
   * @access public
   * @return boolean
   */
  public function close($story_id) {
    $this->id = $story_id;
    return $this->saveField('is_completed', true);
  }

  /**
   * reopen
   *
   * Reopen a story
   *
   * @param mixed $story_id 
   * @access public
   * @return boolean
   */
  public function reopen($story_id) {
    $this->id = $story_id;
    return $this->saveField('is_completed', true);
  }

  /**
   * __findAllByUserId
   *
   * Obtain all stories associated with a particular user.
   *
   * @param mixed $user_id
   * @access public
   * @return array following cake's conventions with basic story data
   */
  public function __findAllByUserId($user_id) {
    $story_ids = array_keys($this->find('user_stories', $user_id));

    $this->bindModel(array(
      'hasOne' => array(
        'LatestEntryUser' => array(
          'className' => 'User',
          'foreignKey' => false,
          'conditions' => array(
            'LatestEntry.user_id = LatestEntryUser.id',
          )
        ),
      ),
    ));

    return $this->find('all', array(
      'conditions' => array('Story.id' => $story_ids),
      'contain' => array(
        'Turn',
        'LatestEntry',
        'LatestEntryUser',
      ),
    ));
  }

  /**
   * __findUserStories
   *
   * Find all stories a user is active in.
   *
   * @param mixed $user_id
   * @access protected
   * @return mixed Array of story names keyed by story id
   */
  protected function __findUserStories($user_id) {
    return Set::combine(
      $this->find('all', array(
        'conditions' => array(
          'id' => $this->StoriesUser->find('stories_by_user', $user_id)
        )
      )),
      '{n}.Story.id',
      '{n}.Story.name'
    );
  }

  /**
   * paginateGetContain
   *
   * Get the containment for the index paginator
   *
   * @access public
   * @return array Containable array
   */
  public function paginateGetContain() {
    return array(
      'Character'       => array('fields' => array('id', 'name', 'slug')),
      'LatestEntry'     => array('fields' => array('id', 'created')),
      'Location'        => array('fields' => array('id', 'name')),
      'Turn'            => array('fields' => array('id', 'username', 'slug')),
      'User'            => array('fields' => array('id', 'username', 'slug')),
      'CharactersStory' =>array('fields' => array(
        'id', 'character_id', 'story_id'
      )),
      'StoriesUser' => array('fields' => array(
        'id', 'story_id', 'user_id'
      )),
    );
  }

  /**
   * paginateBindModels
   *
   * Bind the models needed for the paginator's search / sort
   *
   * @param mixed $relation Relation to bind
   * @access public
   * @return array Models to include in the contain
   */
  public function paginateBindModels($relation) {
    $relations = array(
      'FilterCharacter' => array(
        'CharactersStory',
        'FilterCharacter' => array(
          'className' => 'Character',
          'foreignKey' => false,
          'conditions' => array(
            'FilterCharacter.id = CharactersStory.character_id'
          ),
        ),
      ),
      'FilterUser' => array(
        'StoriesUser',
        'FilterUser' => array(
          'className' => 'User',
          'foreignKey' => false,
          'conditions' => array('FilterUser.id = StoriesUser.user_id'),
        ),
      ),
    );
    $contains = array(
      'FilterCharacter' => array('CharactersStory', 'FilterCharacter'),
      'FilterUser'      => array('StoriesUser',     'FilterUser'),
    );

    if (!isset($relations[$relation])) { return array(); }
    $this->bindModel(array('hasOne' => $relations[$relation]), false);

    return $contains[$relation];
  }
}
?>
