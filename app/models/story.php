<?php
class Story extends AppModel {

  var $name  = 'Story';
  var $order = array('Story.id' => 'DESC');

  var $hasMany             = array('Entry');
  var $hasAndBelongsToMany = array(
    'Character',
    'User' => array('with' => 'StoriesUser'),
  );
  var $belongsTo = array(
    'Location',
    'Turn'         => array(
      'className'  => 'User',
      'foreignKey' => 'user_id_turn',
    )
  );

  var $validate = array(
    'id' => array(
      'required'     => false,
      'allowEmpty'   => false,
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
   * join
   *
   * Join a user to a story optionally specifying whether a user is a moderator.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @param mixed $is_moderator
   * @access public
   * @return boolean True on successful join
   */
  public function join($story_id, $user_id, $is_moderator = false) {
    return $this->StoriesUser->add($story_id, $user_id, $is_moderator);
  }

  /**
   * leave
   *
   * Remove a user from a story. This should only technically toggle the
   * deactivate field.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on successful leave
   */
  public function leave($story_id, $user_id) {
    return $this->StoriesUser->remove($story_id, $user_id);
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
   * findById
   *
   * Overloading default method to only contain pertinent information
   *
   * @param mixed $id Story id
   * @access public
   * @return mixed Story in standard cakephp format
   */
  public function findById($id) {
    // This is extremely wasteful; causes a linear increase in queries as the
    // story grows, which is clearly not acceptable. The issue here is the
    // nested contains. This probably can be cleaned by a simple loop through
    // the result that maps User's and Characters to the first tier's data.
    $this->contain(array(
      'Turn' => array('fields' => array('id', 'username')),
      'User' => array('fields' => array('id', 'username', 'avatar')),
      'Character' => array(
        'fields' => array('id', 'name', 'avatar', 'user_id'),
      ),
      'Entry' => array(
        'Character' => array('fields' => array('id', 'name', 'avatar')),
      ),
      'Location' => array(
        'LocationRegion',
        'LocationPoint',
      ),
    ));

    $result = parent::findById($id);

    if (empty($result)) { return; }

    foreach ($result['Character'] as &$character) {
      $character['User'] = array_shift(
        Set::extract("/User[id={$character['user_id']}]/.[:first]", $result)
      );
    }
    foreach ($result['Entry'] as &$entry) {
      $entry['User'] = array_shift(
        Set::extract("/User[id={$entry['user_id']}]/.[:first]", $result)
      );
    }

    return $result;
  }

  /**
   * findAllByUserId
   *
   * Obtain all stories associated with a particular user. Overrides the default
   * findAllByUserId which in retrospect was a bad idea.
   *
   * @param mixed $id User's user id.
   * @access public
   * @return array following cake's conventions with basic story data
   */
  public function findAllByUserId($id) {
    $this->Character->User->bindModel(array(
      'hasAndBelongsToMany' => array('Story')
    ));
    return Set::extract(
      '/Story',
      $this->Character->User->find('all', array(
        'conditions' => array('id' => $id),
        'contain' => array('Story'),
      ))
    );
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
      'Character'       => array('fields' => array('id', 'name')),
      'FilterCharacter' => array('fields' => array('id', 'name')),
      'FilterUser'      => array('fields' => array('id', 'username')),
      'LatestEntry'     => array('fields' => array('id', 'created')),
      'Location'        => array('fields' => array('id', 'name')),
      'Turn'            => array('fields' => array('id', 'username')),
      'User'            => array('fields' => array('id', 'username')),
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
   * @access public
   * @return void
   */
  public function paginateBindModels() {
    $this->bindModel(array(
      'hasOne' => array(
        'CharactersStory',
        'FilterCharacter' => array(
          'className' => 'Character',
          'foreignKey' => false,
          'conditions' => array(
            'FilterCharacter.id = CharactersStory.character_id'
          ),
        ),
        'StoriesUser',
        'FilterUser' => array(
          'className' => 'User',
          'foreignKey' => false,
          'conditions' => array('FilterUser.id = StoriesUser.user_id'),
        ),
        'LatestEntry' => array(
          'className' => 'Entry',
          'foreignKey' => false,
          'fields' => array('id', 'created'),
          'conditions' => array(
            'LatestEntry.story_id = Story.id',
            'LatestEntry.created in '
              . '(SELECT MAX(created) FROM entries GROUP BY story_id)'
          ),
        ),
      )
    ), false);
  }
}
?>
