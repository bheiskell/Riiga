<div class="stories view">
<h2><?php
  echo $story['Story']['name']; 
  if      ($story['Story']['is_completed'])   __(' (Completed)');
  else if ($story['Story']['is_invite_only']) __(' (Invite Only)');
?></h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link(__('Edit Story', true), array('action' => 'edit', $story['Story']['id'])); ?> </li>
    <li><?php echo $html->link(__('Delete Story', true), array('action' => 'delete', $story['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $story['Story']['id'])); ?> </li>
    <li><?php echo $html->link(__('New Entry', true), array('controller' => 'entries', 'action' => 'add')); ?> </li>
  </ul>
</div>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($story['Story']['location_id']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Turn'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $html->link($story['Turn']['username'], array('controller' => 'users', 'action' => 'view', $story['Turn']['id'])); ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div class="related">
  <?php if (!empty($story['Entry'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <?php
    $i = 0;
    foreach ($story['Entry'] as $entry):
    ?>
    <tr<?php
      if ($entry['is_dialog'] || ($i % 2 == 0)) {
        if ($entry['is_dialog']) echo ' class="isDialog"'; 
        else if ($i % 2 == 0) echo ' class="altrow"';
        else echo ' class="isDialog altrow"';
      }
      $i++;
    ?>>
      <td>
        <?php echo h($entry['User']['username']);?>

        <?php if (!empty($entry['Character'])): ?>
          <ul>
          <?php foreach ($entry['Character'] as $character): ?>
            <li><?php echo h($character['name']); ?></li>
          <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </td>
      <td><?php echo str_replace("\n", "<br/>", h($entry['content']));?></td>

      <?php if ($entry['user_id'] == $session->read('Auth.User.id')): ?>
      <td class="actions">
        <?php echo $html->link(__('Edit', true), array('controller' => 'entries', 'action' => 'edit', $entry['id'])); ?>
        <?php echo $html->link(__('Delete', true), array('controller' => 'entries', 'action' => 'delete', $entry['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['id'])); ?>
      </td>
      <?php endif; ?>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?php echo $html->link(__('New Entry', true), array('controller' => 'entries', 'action' => 'add', 'id' => $story['Story']['id']));?> </li>
    </ul>
  </div>
</div>
<div class="related">
  <h3><?php __('Related Characters');?></h3>
  <?php if (!empty($story['Character'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th><?php __('Name'); ?></th>
    <th><?php __('Avatar'); ?></th>
    <th><?php __('User Id'); ?></th>
  </tr>
  <?php
    $i = 0;
    foreach ($story['Character'] as $character):
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
    ?>
    <tr<?php echo $class;?>>
      <td><?php echo h($character['name']);?></td>
      <td><?php echo h($character['avatar']);?></td>
      <td><?php echo h($character['user_id']);?></td>
      <td><?php echo $html->link(__('View', true), array('controller' => 'characters', 'action' => 'view', $character['id'])); ?></td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

</div>
<div class="related">
  <h3><?php __('Related Users');?></h3>
  <?php if (!empty($story['User'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th><?php __('Username'); ?></th>
    <th><?php __('Avatar'); ?></th>
  </tr>
  <?php
    $i = 0;
    foreach ($story['User'] as $user):
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
    ?>
    <tr<?php echo $class;?>>
      <td><?php echo h($user['username']);?></td>
      <td><?php echo h($user['avatar']);?></td>
      <td>
        <?php $member->avatar($user); ?>
      </td>
      <td class="actions">
        <?php echo $html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

</div>
