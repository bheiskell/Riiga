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
  function isModerator($story_id, $user_id) {
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
   * Add a user to a story optionally specifying moderator status. This actually
   * can be used to perform updates as well.
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @param mixed $is_moderator
   * @access public
   * @return boolean True on success
   */
  function add($story_id, $user_id, $is_moderator = false) {
    $this->id = $this->find('id', compact('story_id', 'user_id'));

    if (!$this->id) { $this->create(); }

    $this->set(array(
      'story_id'       => $story_id,
      'user_id'        => $user_id,
      'is_moderator'   => $is_moderator,
      'is_deactivated' => false,
    ));

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
}
