<?php
class CharactersStory extends AppModel {
  var $name      = 'CharactersStory';
  var $belongsTo = array('Character', 'Story');

  /**
   * confirmStoryMembership
   *
   * Confirm user membership in a story before adding a character.
   *
   * @access private
   * @return boolean
   */
  private function confirmStoryMembership() {
    // TODO - This throws an error to account for invite only stories
  }

  /**
   * add
   *
   * Add a character to a story.
   *
   * @param mixed $story_id
   * @param mixed $character_id
   * @access public
   * @return boolean True on success
   */
  public function add($story_id, $character_id) {
    $this->Behaviors->detach('Deactivatable');

    $this->id = $this->field('id', compact('story_id', 'character_id'));

    $this->Behaviors->attach('Deactivatable');

    if (!$this->id) { $this->create(); }

    $this->set(array(
      'story_id'       => $story_id,
      'character_id'   => $character_id,
      'is_deactivated' => false,
    ));

    return $this->save();
  }

  /**
   * remove
   *
   * Remove a character from a story
   *
   * @param mixed $story_id
   * @param mixed $character_id
   * @access public
   * @return boolean True on success
   */
  public function remove($story_id, $character_id) {
    return $this->deactivate(
      $this->field('id', compact('story_id', 'character_id'))
    );
  }

  /**
   * removeAll
   *
   * Remove all characters from a story for a particular user
   *
   * @param mixed $story_id
   * @param mixed $user_id
   * @access public
   * @return boolean True on success
   */
  public function removeAll($story_id, $user_id) {
    $status = true;
    $character_ids = Set::extract(
      '/CharactersStory/character_id',
      $this->find('all', array(
        'contain'    => array('Character'),
        'conditions' => array(
          'story_id'          => $story_id,
          'Character.user_id' => $user_id,
        ),
      ))
    );
    foreach ($character_ids as $character_id) {
      $status = $status && $this->remove($story_id, $character_id);
    }
    return $status;
  }

  /**
   * beforeValidate
   *
   * Verify a user is associated with a story and if not add them.
   *
   * @access public
   * @return void
   */
  public function beforeValidate() {
    if ( isset($this->data['CharactersStory']['character_id'])
      && isset($this->data['CharactersStory']['story_id'])
    ) {
      $story_id     = $this->data['CharactersStory']['story_id'];
      $character_id = $this->data['CharactersStory']['character_id'];
      $user_id      = $this->Character->getUserIdById($character_id);

      // Add the user to the story. We don't care if this operation succeeds
      // because the result will be checked by the confirmStoryMembership
      // validator. Consequentially, this is not atomic.
      $this->Story->StoriesUser->add(
        $this->data['CharactersStory']['story_id'],
        $user_id
      );
    }
    return true;
  }

  /**
   * afterSave
   *
   * Clean up user associations when a character is deactivated. Because this
   * is run upon each save, multiple character deactivations will be expensive.
   * This warrants a refactor at some point.
   *
   * @access public
   * @return void
   */
  public function afterSave($created) {
    // If we just deactivated the entry, field will deactivatable will filter it
    $this->Behaviors->detach('Deactivatable');

    $story_id = $this->field('story_id');

    $this->Behaviors->attach('Deactivatable');

    $this->Story->StoriesUser->cleanup($story_id);
  }
}
?>
