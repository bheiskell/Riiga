<?php
class StoriesUser extends AppModel {

  var $name      = 'StoriesUser';
  var $belongsTo = array('Story', 'User');

  /**
   * isModerator
   *
   * Return whether a particular user is a moderator for a story
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True if user is a story moderator
   */
  public function isModerator($story_id, $user_id) {
    $isAdmin = $this->User->isAdmin($user_id);

    $isModerator = count(
      $this->find('all', array(
        'conditions' => array(
          'story_id'     => $story_id,
          'user_id'      => $user_id,
          'is_moderator' => true,
        )
      ))
    );

    return $isModerator || $isAdmin;
  }

  /**
   * checkInvites
   *
   * Validator function verifying story invites before allowing a user to join
   * a story.
   *
   * @access private
   * @return void
   */
  private function checkInvites() {
    // TODO: test and install once the invite system is complete

    // Need a conditional check for if the user is already part of the story.

    if ($this->Story->field('is_invite_only', array('id' => $story_id))) {
      return 1 ==$this->Story->Invite->find('count', array(
        'story_id' => $story_id,
        'user_id'  => $user_id
      ));
    }
    return true;
  }

  /**
   * __findId
   *
   * Find the row that maps a user to a story. There should only be one.
   *
   * @param mixed $options Array keyed with a story_id and user_id
   * @access protected
   * @return int Id of the row mapping the user to a story
   */
  protected function __findId($options) {
    $results = $this->find('all', array(
      'deactivated' => true,
      'conditions' => array(
        'story_id' => $options['story_id'],
        'user_id'  => $options['user_id'],
      ),
    ));

    $count = count($results);
    if (0 == $count) { return false; }
    if (1 != $count) {
      $this->log(
        sprintf('StoriesUser: %d entries found for the same user', $count)
      );
    }

    return $results[0][$this->alias][$this->primaryKey];
  }

  /**
   * __findStoriesByUser
   *
   * Look up stories by a particular user.
   *
   * @param mixed $user_id
   * @access protected
   * @return array Array of story ids for the specified user
   */
  protected function __findStoriesByUser($user_id) {
    return $this->find('list', array(
      'fields'     => array('id', 'story_id'),
      'conditions' => array('user_id' => $user_id),
    ));
  }

  /**
   * add
   *
   * Add a user to a story optionally specifying moderator status. This actuall
   * can be used to perform updates as well.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @param mixed $is_moderator
   * @access public
   * @return boolean True on success
   */
  function add($story_id, $user_id, $is_moderator = null) {

    $this->id = $this->find('id', compact('story_id', 'user_id'));

    if (!$this->id) { $this->create(); }

    $this->set(array(
      'story_id'       => $story_id,
      'user_id'        => $user_id,
      'is_deactivated' => false,
    ));

    if (null !== $is_moderator) { $this->set('is_moderator', $is_moderator); }

    return $this->save();
  }

  /**
   * remove
   *
   * Remove a user from a story. Technically deactivates the user so that
   * lookups for the story will include legacy information about users that
   * have left the story.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on successful removal.
   */
  function remove($story_id, $user_id) {
    return $this->deactivate($this->find('id', compact('story_id', 'user_id')));
  }

  /**
   * cleanup
   *
   * Ensure all active users have at least on active character in a story. If
   * not, deactivate the user. This is stupid expensive and should be
   * refactored. Efficiency relies on the general case of < 3 users and 1
   * character per user.
   *
   * @param mixed $story_id
   * @access public
   * @return void
   */
  function cleanup($story_id) {
    $user_ids = Set::extract(
      '/StoriesUser/user_id',
      $this->findAllByStoryId($story_id)
    );
    foreach($user_ids as $user_id) {
      $characters = $this->Story->CharactersStory->find('count', array(
        'conditions' => array(
          'story_id' => $story_id,
          'Character.user_id' => $user_id,
        ),
        'contain' => array('Character.user_id'),
      ));
      if (0 == $characters) {
        $this->remove($story_id, $user_id);
      }
    }
  }
}
