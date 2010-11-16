<?php
class StoriesController extends AppController {

  var $name = 'Stories';

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'filter', 'view');
  }

  function index() {
    $this->Story->paginateBindModels();
    $this->paginate['contain'] = $this->Story->paginateGetContain();
    $this->set('stories', $this->paginate($this->paginateGetFilters()));
  }

  function filter($id = null) { }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Story', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->set('story', $this->Story->findById($id));
  }

  function add()     { $this->form(); }
  function edit($id) { $this->form($id); }

  function form($id = null) {
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

    $characters = $this->Story->Character->find('list');
    $users      = $this->Story->User->find('list');
    $turns      = $this->Story->Turn->find('list');
    $locations  = $this->Story->Location->find('list');
    $this->set(compact('characters', 'users', 'turns', 'locations'));
    $this->render('form');
  }

  /**
   * paginateGetFilters
   *
   * Obtain filters for the search fields from the filter form.
   *
   * @access private
   * @return Array acceptable by $this->paginate
   */
  private function paginateGetFilters() {
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
