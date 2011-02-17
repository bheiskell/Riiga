<?php
class StoriesController extends AppController {
  var $name = 'Stories';

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'filter', 'view');
  }

  function _isModerator() {
    if ($id = $this->_getParam('pass', 0)) {
      if (is_numeric($id)) {
        $this->Story->id = $id;
      } else {
        $this->Story->id = Set::extract(
          '/Story/id',
          $this->Story->findBySlug($id)
        );
      }
    }

    return $this->Story->isModerator($this->Story->id, $this->Auth->user('id'));
  }

  function index() {
    $this->paginate['contain'] = $this->Story->paginateGetContain();
    $this->paginate['order']   = array('LatestEntry.created DESC');
    $this->set('stories', $this->paginate($this->_paginateGetFilters()));
  }

  function filter($id = null) { }

  function view($slug = null) {
    $id = Set::extract('/Story/id', $this->Story->findBySlug($slug));

    $isMember = $this->Story->isMember($id, $this->Auth->user('id'));

    $story      = $this->Story->findById($id);
    $location   = $this->Story->Location->find('first_by_story_id', $id);
    $characters = $this->Story->Character->find('all_by_story_id', $id);
    $users      = $this->Story->User     ->find('all_by_story_id', $id);

    $this->paginate = $this->Story->Entry->paginateGetStory($id);
    $entries = $this->paginate('Entry');

    $this->set(compact(
      'story',
      'location',
      'entries',
      'characters',
      'users',
      'isMember'
    ));

    if (empty($this->viewVars['story'])) {
      $this->cakeError('error404');
    }

    $this->pageTitle = 'Stories - ' . $story['Story']['name'];
  }

  function add() {
    $this->_form();
  }

  function add_character($story_id = null) {
    $user_id = $this->Auth->user('id');

    if (!empty($this->data)) {
      $character_id = $this->data['CharactersStory']['character_id'];
      $story_id     = $this->data['CharactersStory']['story_id'];

      $message = $this->Story->addCharacter($story_id, $character_id, $user_id)
          ? 'Character added to the story'
          : 'Failed to add the character to the story; is the character in another story?';

      $this->_backToView($message, $story_id);
    }

    $characters = $this->Story->Character->find('available', $user_id);
    $story_name = $this->Story->getNameById($story_id);

    if (false === $story_name) {
      $this->flash('That story could not be found');
    }

    $this->set(compact('characters', 'story_name', 'story_id'));
  }

  function remove_character($story_id = null) {
    $user_id      = $this->Auth->user('id');
    $character_id = $this->_getParam('named', 'character_id');

    $message =
      $this->Story->removeCharacter($story_id, $character_id, $user_id)
        ? 'Character successfully removed'
        : 'Failed to remove characters';

    $this->_backToView($message, $story_id);
  }

  function remove_all_characters($story_id = null) {
    $message =
      $this->Story->removeAllCharacters($story_id, $this->Auth->user('id'))
        ? 'Your characters have been removed from the story'
        : 'Failed to remove characters';

    $this->_backToView($message, $story_id);
  }

  function moderator_edit($story_id = null) {
    $this->_form($story_id);
  }

  function moderator_close($story_id = null) {
    $message = ($this->Story->close($story_id))
      ? 'Story has been closed'
      : 'Failed to close story';
    $this->_backToView($message, $story_id);
  }

  function moderator_reopen($story_id = null) {
    $message = ($this->Story->reopen($story_id))
      ? 'Story has been reopened'
      : 'Failed to reopen story';
    $this->_backToView($message, $story_id);
  }

  function moderator_promote($story_id = null) {
    $user_id = $this->_getParam('named', 'user_id');
    $message = ($this->Story->promote($story_id, $user_id))
      ? 'Member has been promoted to moderator status.'
      : 'Member promotion to moderator failed.';
    $this->_backToView($message, $story_id);
  }

  function moderator_demote($story_id = null) {
    $user_id = $this->_getParam('named', 'user_id');
    $message = ($this->Story->demote($story_id, $user_id))
      ? 'Member has been demoted to author status.'
      : 'Member demotion from moderator failed.';
    $this->_backToView($message, $story_id);
  }

  function moderator_remove_character($story_id = null) {
    $character_id = $this->_getParam('named', 'character_id');
    $message = ($this->Story->removeCharacter($story_id, $character_id))
      ? 'Character successfully removed'
      : 'Failed to remove characters';
    $this->_backToView($message, $story_id);
  }

  function _form($id = null) {
    // TODO: Make a call to the story's model that will check for a location
    // change and create a location change entry in that case. Issue 43
    //
    // TODO: Check that user is in the users section and is moderator.
    if (!empty($this->data)) {

      if (!$this->Story->id) { $this->Story->create(); }

      if ($this->Story->save($this->data)) {
        $this->Session->setFlash(__('The Story has been saved.', true));
        $this->redirect(array(
          'action' => 'view',
          'id' => $this->Story->field('slug')
        ));
      }
    }

    if ($id && empty($this->data)) {
      $this->data = $this->Story->read(null, $id);
    } else {
      $this->data['Story']['user_id_turn'] = $this->Auth->user('id');
    }
    $locationInfo = $this->Story->Location->find('info');
    $locations    = $this->Story->Location->generatetreelist(0, 0, 0, '|  ');
    $this->set(
      compact('characters', 'userIdTurns', 'turns', 'locations', 'locationInfo')
    );
    $this->render('form');
  }

  /**
   * _paginateGetFilters
   *
   * Obtain filters for the search fields from the filter form.
   *
   * @access private
   * @return Array acceptable by $this->paginate
   */
  private function _paginateGetFilters() {
    $filters = Set::filter($this->postConditions($this->data, array(
        'FilterCharacter.name' => 'LIKE',
        'FilterUser.username'  => 'LIKE',
        'Location.name'        => 'LIKE',
        'Story.name'           => 'LIKE',
        'Story.is_completed'   => '=',
        'Story.is_invite_only' => '=',
      ), 'AND', true
    ));

    // Post conditions creates '%%' for empty LIKE fields. This results in
    // removing rows that have NULL for those fields.
    if (is_array($filters)) {
      function removeEmptyLikes($condition) { return !($condition == '%%'); }

      $filters = array_filter($filters, 'removeEmptyLikes');

      // In stock cakephp, group by does not behave correctly when pagination
      // is involved. Instead, bind models on demand to avoid duplicate rows.
      foreach (array_keys($filters) as $filter) {
        $this->paginate['contain'] = array_merge(
          $this->Story->paginateBindModels(array_shift(explode('.', $filter))),
          $this->paginate['contain']
        );
      }
    }
    return $filters;
  }

  /**
   * _backToView
   *
   * Redirect to a story with a message
   *
   * @param mixed $message
   * @param mixed $id
   * @access private
   * @return void
   */
  private function _backToView($message, $id) {
    $this->flash($message, array(
      'action' => 'view',
      'id'     => $this->Story->field('slug', compact('id')),
    ));
  }
}
