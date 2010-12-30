<?php
class InvitesController extends AppController {
  var $name     = 'Invites';

  function beforeFilter() {
  }

  function user($user_id = false) {
    if (!empty($this->data)) {
      $this->Invite->create();
      $message = ($this->Invite->save($this->data))
        ? 'Invitation sent'
        : 'Invitation failed';
      $this->flash($message, array('controller' => 'users'));
    }
    $stories = $this->Invite->Story->findAllByUserId($this->Auth->user('id'));
    foreach ($stories as $key => $story) {
      if (!$story['Story']['StoriesUser']['is_moderator']) {
        unset($stories[$key]);
      }
    }
    $stories = Set::combine(
      $stories,
      '{n}.Story.id',
      '{n}.Story.name'
    );

    $username = $this->Invite->User->field('username', array('id' => $user_id));
    if (!$username) { $this->flash('Invalid member', '/'); }

    $this->data['Invite']['user_id'] = $user_id;

    $this->set(compact('stories', 'username'));
  }
}
?>
