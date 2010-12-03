<div class="stories view">
<ul class="todo">
  <li>Change story name</li>
  <li>Delete entries</li>
  <li>Promote / demote user to story moderator</li>
  <li>Paginate entries</li>
</ul>
<h2>
  <?php echo $story['Story']['name']; ?>
  <?php echo $story['Story']['is_completed']   ? __(' (Completed)')   : null; ?>
  <?php echo $story['Story']['is_invite_only'] ? __(' (Invite Only)') : null; ?>
</h2>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('Post', true),
          array(
            'controller' => 'entries',
            'action' => 'add',
            $story['Story']['id']
          )
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Add Character', true),
          array('action' => 'add_character', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Invite', true),
          array('action' => 'invite', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Manage', true),
          array('action' => 'manage', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Join', true),
          array('action' => 'join', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Leave', true),
          array('action' => 'leave', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Set to Invite Only', true),
          array('action' => 'toggle_invite_only', $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Close', true),
          array('action' => 'close', $story['Story']['id'])
        );
      ?>
    </li>
  </ul>
</div>
<div>
  <dl>
    <dt><?php __('Location Id'); ?></dt>
    <dd>
      <?php echo h($story['Story']['location_id']); ?>
      &nbsp;
    </dd>
    <dt><?php __('Turn'); ?></dt>
    <dd>
      <?php
        echo $html->link($story['Turn']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $story['Turn']['id']
        ));
      ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div>
<?php if (!empty($story['Entry'])):?>
  <table cellpadding = "0" cellspacing = "0">
    <?php $altrow->reset(); ?>
    <?php foreach ($story['Entry'] as $entry): ?>
      <?php $isDialog = ($entry['is_dialog']) ? 'is_dialog' : null; ?>
      <tr<?php echo $altrow->get($isDialog); ?>>
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
            <?php
              echo $html->link(__('Edit', true), array(
                'controller' => 'entries',
                'action' => 'edit',
                $entry['id']
              ));
            ?>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>

<div class="related">
  <h3><?php __('Members');?></h3>
  <?php if (!empty($story['User'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th>&nbsp;</th>
    <th><?php __('Username'); ?></th>
  </tr>
  <?php $altrow->reset(); ?>
  <?php foreach ($story['User'] as $user): ?>
    <tr<?php echo $altrow;?>>
      <td><?php echo $avatar->user($user); ?></td>
      <td>
        <?php
          echo $html->link($user['username'], array(
            'controller' => 'users',
            'action' => 'view',
            $user['id']
          ));
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

<div class="related">
  <h3><?php __('Characters');?></h3>
  <?php if (!empty($story['Character'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th>&nbsp;</th>
    <th><?php __('Name'); ?></th>
    <th><?php __('Member'); ?></th>
  </tr>
  <?php $altrow->reset(); ?>
  <?php foreach ($story['Character'] as $character): ?>
    <tr<?php echo $altrow;?>>
      <td><?php echo $avatar->avatar($character);?></td>
      <td>
        <?php
          echo $html->link(
            $character['name'],
            array(
              'controller' => 'characters',
              'action' => 'view',
              $character['id']
            )
          );
        ?>
      </td>
      <td><?php echo h($character['User']['username']);?></td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>

</div>
