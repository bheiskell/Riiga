<ul class="todo">
  <li>List all stories (include character name here if set)</li>
</ul>
<div class="users view">
  <h2><?php echo h($user['User']['username']); ?></h2>
  <div class="avatar"><?php echo $riiga->avatar($user['User']); ?></div>
  <ul>
    <?php if ($session->read('Auth.User.id') == $user['User']['id']): ?>
      <li>
        <?php
          echo $html->link(__('Edit profile', true), array('action' => 'edit'));
        ?>
      </li>
    <?php endif; ?>
    <li>
      <?php
        echo $html->link(
          __('Invite to a story', true),
          array(
            'controller' => 'story',
            'action' => 'invite',
            'user_id' => $user['User']['id'],
          )
        );
      ?>
    </li>
    <li>
      <?php if ($user['User']['url']): ?>
        <?php echo $html->link( __("Website", true), $user['User']['url']); ?>
      <?php else: ?>
        <?php
          echo $html->link(
            __('Send private message', true),
            array('action' => 'message', $user['User']['id'])
          );
        ?>
      <?php endif; ?>
    </li>
  </ul>
  <?php if (!empty($user['Character'])):?>
    <div class="related">
      <h3><?php __('Characters');?></h3>
      <?php echo $this->element('characters'); ?>
    </div>
  <?php endif; ?>
</div>
