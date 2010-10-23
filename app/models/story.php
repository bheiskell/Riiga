<?php
class Story extends AppModel {

  var $name   = 'Story';
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
    ));

    $result = parent::findById($id);

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
