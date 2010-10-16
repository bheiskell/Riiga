<?php
class Story extends AppModel {

  var $name   = 'Story';
  var $actsAs = array('Containable');
  var $order  = array('Story.id' => 'desc');

  var $hasMany             = array('Entry');
  var $hasAndBelongsToMany = array('Character', 'User');
  var $belongsTo           = array(
    'Location',
    'Turn' => array(
      'className' => 'User',
      'foreignKey' => 'user_id_turn',
    )
  );

  /**
   * findAllByUserId
   *
   * Obtain all stories associated with a particular user.
   *
   * @param mixed $id User's user id.
   * @access public
   * @return array following cake's conventions with basic story data
   */
  public function findAllByUserId($id) {
    return Set::extract(
      '/Character/Story[name=/.*/]',
      $this->Character->User->find('all', array(
        'conditions' => array('id' => $id),
        'contain' => array(
          'Character' => array(
            'fields' => array('id', 'name'),
            'Story' => array(
              'fields' => array('id', 'name'),
            ),
          ),
        ),
      ))
    );
  }

  /**
   * paginateGetContainables
   *
   * Get the containment for the index paginator
   *
   * @access public
   * @return void
   */
  public function paginateGetContainables() {
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
          )
        ),
        'StoriesUser',
        'FilterUser' => array(
          'className' => 'User',
          'foreignKey' => false,
          'conditions' => array('FilterUser.id = StoriesUser.user_id')
        ),
        'LatestEntry' => array(
          'className' => 'Entry',
          'foreignKey' => false,
          'fields' => array('id', 'created'),
          'conditions' => array(
            'LatestEntry.story_id = Story.id',
            'LatestEntry.created in '
              . '(SELECT MAX(created) FROM entries GROUP BY story_id)'
          )
        ),
      )
    ), false);
  }
}
?>
