<div class="users view">
  <h2><?php echo h($user['User']['username']); ?></h2>
  <div class="avatar"><?php echo $avatar->avatar($user['User']); ?></div>
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
  <?php if (!empty($stories)):?>
    <div class="related">
      <h3><?php __('Stories');?></h3>
      <table>
        <thead>
          <tr><th>Name</th></tr>
        </thead>
        <tbody>
          <?php $altrow->reset(); ?>
          <?php foreach($stories as $story): ?>
            <tr<?php echo $altrow; ?>>
              <td>
                <?php
                  echo $html->link(
                    $story['Story']['name'],
                    array(
                      'controller' => 'stories',
                      'action' => 'view',
                      $story['Story']['id']
                    )
                  );
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
