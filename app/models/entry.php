<?php
class Entry extends AppModel {

  var $name  = 'Entry';
  var $order = array('Entry.modified' => 'DESC');

  var $belongsTo           = array('Story', 'User');
  var $hasAndBelongsToMany = array('Character');

  var $validate = array(
    'id' => array(
      'required'     => false,
      'allowEmpty'   => true,
      'rule'         => array('numeric'),
      'message'      => 'Invalid entry id'
    ),
    'content' => array(
      'required'     => true,
      'rule'         => array('notEmpty'),
      'message'      => 'An entry must have content.'
    ),
    'Character' => array(
      'required'     => true,
      'allowEmpty'   => true,
    ),
    'story_id' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('verifyUserParticipation'),
      'message'      => 'The author does not have access to this story.'
    ),
    'user_id' => array(
      'user_immutability' => array (
        'required'     => true,
        'allowEmpty'   => false,
        'rule'         => array('verifyUserImmutability'),
        'message'      => 'Ownership of a post is immutable.',
      ),
      'double_post' => array (
        'rule'         => array('checkForDoublePost'),
        'message'      => 'You are not allowed to post two entries in a row. Instead, edit the previous entry to include your addition.',
      ),
    ),
  );

  /**
   * beforeValidate
   *
   * Can't apply habtm custom validation rules using the tradition approach.
   * Checking the Character associations here instead.
   *
   * @access public
   * @return boolean True on valid character relationship
   */
  function beforeValidate() {
    if (!isset($this->data['Character'])) return true;

    $count = is_array($this->data['Character']['Character'])
           ? count($this->data['Character']['Character']) : 0;
    $found = $this->Character->find('count', array(
      'conditions' => array(
        'id'      => $this->data['Character']['Character'],
        'user_id' => $this->data['Entry']['user_id'],
      ),
    ));
    if ($found !== $count) {
      $this->invalidate('Character', array(
        'Character' => __('Character must belong to the entry author', true)
      ));
    }
    return ($found === $count);
  }

  /**
   * verifyUserParticipation
   *
   * Verify the user is associated with this story before allowing them to post
   * to it. This shouldn't cause admin edits to break. To accomplish this, only
   * check the user_id set in the data. A seperate check will be made to ensure
   * a post cannot be hijacked.
   *
   * @access public
   * @return boolean True on valid field
   */
  function verifyUserParticipation() {
    $matches = $this->Story->StoriesUser->find('count', array(
      'conditions' => array(
        'story_id' => $this->data['Entry']['story_id'],
        'user_id'  => $this->data['Entry']['user_id'],
      ),
      // in case a moderator edits a post of a user who has left the story.
      'deactivated' => true,
    ));
    return (1 == $matches);
  }

  /**
   * verifyUserImmutability
   *
   * Ensure the ownership of a post isn't changed during an edit.
   *
   * @access public
   * @return boolean True on valid field
   */
  function verifyUserImmutability() {
    if (isset($this->data['Entry']['id']) && $this->data['Entry']['id']) {
      $this->id = $this->data['Entry']['id'];
      return $this->data['Entry']['user_id'] == $this->field('user_id');
    }
    return true;
  }

  /**
   * checkForDoublePost
   *
   * Ensure the user isn't posting twice in a row. This restriction is intended
   * to deter users from artifically boosting their rank.
   *
   * @access public
   * @return boolean True on valid field
   */
  function checkForDoublePost() {
    if (isset($this->data['Entry']['story_id'])
      && (!isset($this->data['Entry']['id'])
        || empty($this->data['Entry']['id'])
      )
    ) {
      $story_id = $this->data['Entry']['story_id'];
      $user_id  = $this->find('latest_user_id', $story_id);
      return $this->data['Entry']['user_id'] != $user_id;
    }
    return true;
  }

  function afterSave($created) {
    if (isset($this->data['Entry']['story_id'])) {
      $this->Story->rotateTurn($this->data['Entry']['story_id']);
    }
    $this->clearCache();
  }

  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    // This may not scale well as every time a post is made, the full cache is
    // cleared, but until profiling says otherwise, this will.
    Cache::delete('EntryCountByUserId');
  }

  /**
   * findCountByUserId
   *
   * Obtain the number of entries created by a particular user
   *
   * @param mixed $user_id User to look up
   * @access public
   * @return int Number of entries created by the user
   */
  public function findCountByUserId($user_id) {
    $results = Cache::read('EntryCountByUserId');

    if (false === $results) { $results = array(); }

    if (!isset($results[$user_id])) {
      $results[$user_id] = $this->find('count', array(
        'conditions' => array('user_id' => $user_id)
      ));
      Cache::write('EntryCountByUserId', $results);
    }

    return $results[$user_id];
  }

  /**
   * paginateGetStoryContain
   *
   * Contains required to view a story's entries.
   *
   * @param mixed $story_id
   * @access public
   * @return array Contain array for the paginator
   */
  public function paginateGetStory($story_id) {
    return array(
      'conditions' => compact('story_id'),
      'contain'    => array('Character', 'User'),
      'order'      => array('Entry.id ASC'),
    );
  }

  /**
   * __findLatestUserId
   *
   * Find the latest user to post in a story.
   *
   * @param mixed $story_id
   * @access protected
   * @return int User id
   */
  protected function __findLatestUserId($story_id) {
    $result = $this->find('first', array(
      'conditions' => compact('story_id'),
      'order' => array('id DESC'),
    ));
    return isset($result['Entry']['user_id'])
      ? $result['Entry']['user_id'] : false;
  }
}
?>
