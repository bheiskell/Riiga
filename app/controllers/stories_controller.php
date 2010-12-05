<?php
class StoriesController extends AppController {
  var $name = 'Stories';

  /**
   * _isModerator
   *
   * Overloading the AppController's callback for checking moderator status
   *
   * @access protected
   * @return boolean True if moderator
   */
  function _isModerator() {
    if ($id = $this->_getParam('pass', 0)) { $this->Story->id = $id; }

    return $this->Story->isModerator($this->Story->id, $this->Auth->user('id'));
  }

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'filter', 'view');
  }

  function index() {
    $this->Story->paginateBindModels();
    $this->paginate['contain'] = $this->Story->paginateGetContain();
    $this->paginate['group'] = array('Story.id');
    $this->set('stories', $this->paginate($this->_paginateGetFilters()));
  }

  function filter($id = null) { }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->set('story', $this->Story->findById($id));
  }

  function add()            { $this->_form(); }
  function edit($id = null) { $this->_form($id); }

  function _form($id = null) {
    // TODO: Make a call to the story's model that will check for a location
    // change and create a location change entry in that case. Issue 43
    //
    // TODO: Check that user is in the users section and is moderator.
    if (!empty($this->data)) {

      if (!$this->Story->id) { $this->Story->create(); }

      if ($this->Story->save($this->data)) {
        $this->Session->setFlash(__('The Story has been saved.', true));
        $this->redirect(array('action' => 'view', 'id' => $this->Story->id));
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

  function join($story_id = null) {
    if ($this->Story->join($story_id, $this->Auth->user('id'))) {
      $this->flash(
        'You are now an author of this story; add a character to post.',
        array('action' => 'view', 'id' => $story_id)
      );
    } else {
      $this->flash('Failed to join the story', array('action' => 'index'));
    }
  }

  function leave($story_id = null) {
    if ($this->Story->leave($story_id, $this->Auth->user('id'))) {
      $this->flash(
        'You are no longer an active author of this story.',
        array('action' => 'view', 'id' => $story_id)
      );
    } else {
      $this->flash('Failed to leave the story', array('action' => 'index'));
    }
  }

  function add_character($story_id = null) {
    // is a member of the story
    $user_id    = $this->Auth->user('id');
    $characters = $this->Story->Character->find('available', $user_id);
  }

  function remove_character($story_id = null) {
    // is owner, story moderator, or admin
    // CharactersStory
  }

  function moderator_promote($story_id = null) {
    $user_id = $this->_getParam('named', 'user_id');
    if ($this->Story->promote($story_id, $user_id)) {
      $message = 'Member has been promoted to moderator status.';
    } else {
      $message = 'Member promotion to moderator failed.';
    }
    $this->flash($message, array('action' => 'view', 'id' => $story_id));
  }

  function moderator_demote($story_id = null) {
    $user_id = $this->_getParam('named', 'user_id');
    if ($this->Story->demote($story_id, $user_id)) {
      $message = 'Member has been demoted to author status.';
    } else {
      $message = 'Member demotion from moderator failed.';
    }
    $this->flash($message, array('action' => 'view', 'id' => $story_id));
  }

  function moderator_remove_character($story_id = null) {
    // is owner, story moderator, or admin
    // CharactersStory
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
    }

    return $filters;
  }
}
