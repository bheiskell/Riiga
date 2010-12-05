<?php
class InvitesController extends AppController {
  var $name     = 'Invites';
  var $user_id  = null;
  var $story_id = null;

  function beforeFilter() {
    $this->user_id  = $this->_getParam('named', 'user_id');
    $this->story_id = $this->_getParam('named', 'story_id');
  }

  function _isModerator() {
    return true;
  }

  function send() {
    // is story moderator, or admin
    if (!empty($this->data)) {
      $user_id  = $this->data['Story']['user_id'];
      $story_id = $this->data['Story']['id'];

      if (!$this->Story->isModerator($story_id, $this->Auth->user('id'))) {
        $this->flash(
          'You do not have permissions to invite members to this story.',
          array('action' => 'view', 'id' => $this->story_id)
        );
      }
      if ($this->Story->inviteUser($this->data)) {
        $this->flash(
          'Invitation has been sent.',
          array('action' => 'view', 'id' => $this->story_id)
        );
      } else {
        $this->Session->setFlash(__('An error occured.', true));
      }
    }
    $user = $this->Story->User->findById($this->user_id);
    if (empty($user)) {
      $this->Session->setFlash(__('The selected member does not exist.', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->data['Story']['user_id'] = $this->user_id;
    $ids = $this->Story->find('user_stories', $this->Auth->user('id'));
    $this->set(compact('user', 'ids'));
  }

  function accept() {
    // is user or admin
  }

  function revoke() {
    // is story moderator or admin
    if (!$this->user_id || !$this->story_id) {
      $this->flash('Error, the specified story / member is invalid.');

    } else if (!$this->Story->isModerator($this->story_id, $this->Auth->user('id'))) {
      $this->flash(
        'You do not have permissions to remove members from this story.',
        array('action' => 'view', 'id' => $this->story_id)
      );
    } else if ($this->Story->removeUser($this->story_id, $this->user_id)) {
      $this->flash(
        'Member successfully removed.',
        array('action' => 'view', 'id' => $this->story_id)
      );
    } else {
      $this->flash(
        'Member is already removed or and unknown error occurred.',
        array('action' => 'view', 'id' => $this->story_id)
      );
    }
  }
}
?>
