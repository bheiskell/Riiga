<?php
class EntriesController extends AppController {

  var $name = 'Entries';

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index');
  }

  function _isModerator() {
    if ($id = $this->_getParam('pass', 0)) { $this->Entry->id = $id; }

    $story_id = $this->Entry->field('story_id');

    return $this->Entry->Story->isModerator($story_id, $this->Auth->user('id'));
  }

  function index() {
    $this->paginate['contain'] = array('Story', 'User');
    $this->set('entries', $this->paginate());
  }

  function add() {
    $this->_form(array(
      'story_id' => $this->_getParam('named', 'story_id'),
      'user_id'  => $this->Auth->user('id')
    ));
  }

  function edit($entry_id = null) {
    $this->_form(array('entry_id' => $entry_id));
  }

  function moderator_edit($entry_id = null) {
    $this->_form(array('entry_id' => $entry_id, 'is_moderator' => true));
  }

  function remove($entry_id = null) {
    $this->_remove($entry_id);
  }

  function moderator_remove($entry_id = null) {
    $this->_remove($entry_id, true);
  }

  private function _form($args) {
    $args = array_merge(
      array(
        'entry_id'     => false,
        'story_id'     => false,
        'is_moderator' => false,
      ),
      $args
    );

    if (!empty($this->data)) {
      if (!isset($this->data['Entry']['id'])) {
        $this->Entry->create();
      }

      if (!$args['is_moderator']) {
        $this->data['Entry']['user_id'] = $this->Auth->user('id');
      }

      if ($this->Entry->save($this->data)) {
        $this->flash('Your entry has been saved', array(
          'controller' => 'stories',
          'action'     => 'view_latest',
          'id'         => $this->data['Entry']['story_id']
        ));
      } else {
        $this->Session->setFlash(
          __('There was a problem with your submission', true)
        );
      }
    } else if ($args['entry_id']) {
      $this->Entry->contain('Character');
      $this->data = $this->Entry->findById($args['entry_id']);
      if (empty($this->data)) {
        $this->flash('Entry not found');
      }
    }

    if (isset($this->data['Entry'])) {
      $args['story_id'] = $this->data['Entry']['story_id'];
      $args['user_id']  = $this->data['Entry']['user_id'];
    }

    if (!$args['story_id']) {
      $this->flash('To add an entry, you must specify a story');
    } else {
      $this->data['Entry']['story_id'] = $args['story_id'];
    }

    $story      = $this->Entry->Story->findById($args['story_id']);
    $characters = $this->Entry->Character->find('list_by_story_and_user', array(
      'story_id' => $args['story_id'],
      'user_id'  => $args['user_id'],
    ));

    $this->set(compact('characters', 'story'));

    $this->render('form');
  }

  private function _remove($entry_id, $is_moderator = false) {
    $this->Entry->id = $entry_id;
    $user_id  = $this->Entry->field('user_id');
    $story_id = $this->Entry->field('story_id');

    if ( $this->Auth->user('id') == $user_id || $is_moderator) {
      $message = $this->Entry->deactivate($entry_id)
        ?  'Entry successfully deleted.' : 'Failed to delete entry';
    } else {
      $message = 'Entries can only be deleted by the author or a moderator.';
    }
    $this->flash($message, array(
      'controller' => 'stories',
      'action'     => 'view',
      'id'         => $story_id,
      'moderator'  => false,
    ));
  }

}
?>
