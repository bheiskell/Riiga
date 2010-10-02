<div class="users view">
<h2><?php echo h($user['User']['username']); ?></h2>
<?php
  echo $html->div('avatar', $riiga->avatar($user['User']));

  $currentUser = $session->read('Auth.User');
  if ($currentUser['id'] == $user['User']['id']) {
    echo $html->div('edit', $html->link(__('Edit profile', true), array('action' => 'edit')));
  }

  if ($user['User']['url']) {
    echo $html->div('website',
      $html->link(
        $user['User']['username'] . "'s website",
        $user['User']['url']
      )
    );
  }
?>
<?php echo $html->link(
  __('Invite', true)
    . " {$user['User']['username']} "
    . __('to a story', true),
  array(
    'controller' => 'story',
    'action' => 'invite',
    'user_id' => $user['User']['id'],
  )
); ?>
<?php echo $html->link(
  __('Send private message', true),
  array(
    'action' => 'message',
    $user['User']['id'],
  )
); ?>
<ul class="todo">
  <li>List all stories (include character name here if set)</li>
</ul>
</div>
<?php if (!empty($user['Character'])):?>
<div class="related">
  <h3><?php __('Characters');?></h3>
  <?php echo $this->element('characters'); ?>
</div>
<?php endif; ?>
