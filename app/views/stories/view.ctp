<div class="stories view">
<ul class="todo">
  <li>Change story name</li>
  <li>Delete entries</li>
  <li>Promote / demote user to story moderator</li>
  <li>Paginate entries</li>
</ul>
<h2>
  <?php echo $story['Story']['name']; ?>
  <?php $story['Story']['is_completed']   ? __(' (Completed)')   : null; ?>
  <?php $story['Story']['is_invite_only'] ? __(' (Invite Only)') : null; ?>
</h2>
<?php if (!empty($story['Entry'])):?>
  <table id="entries" cellpadding = "0" cellspacing = "0">
    <?php $altrow->reset(); ?>
    <?php foreach ($story['Entry'] as $entry): ?>
      <?php $isDialog = ($entry['is_dialog']) ? 'is_dialog' : null; ?>
      <tr<?php echo $altrow->get($isDialog); ?>>
        <td class="avatar">
          <?php echo $avatar->user($entry['User'], true);?>
          <?php if (!empty($entry['Character'])): ?>
            <ul>
              <?php foreach ($entry['Character'] as $character): ?>
                <li>
                  <?php echo $avatar->character($character, true); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </td>
        <td>
        <?php echo h($entry['created']);?>
        <pre><?php echo h($entry['content']);?></pre>
        </td>

        <td class="actions">
          <?php if ($entry['user_id'] == $session->read('Auth.User.id')): ?>
            <?php
              echo $html->link(__('Edit', true), array(
                'controller' => 'entries',
                'action' => 'edit',
                $entry['id']
              ));
            ?>
          <?php endif; ?>
          &nbsp;
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>

<div class="related">
  <div style="float:right;">
  <?php
    echo $minimap->render(array(
      'region' => $story['Location']['LocationRegion'],
      'point'  => $story['Location']['LocationPoint'],
    ));
  ?>
  </div>
  <?php if (!empty($story['User'])):?>
  <table cellpadding = "0" cellspacing = "0" style="float:left; width: 70%;">
  <tr>
    <th><?php __('Member'); ?></th>
    <th><?php __('Characters'); ?></th>
  </tr>
  <?php $altrow->reset(); ?>
  <?php foreach ($story['User'] as $user): ?>
    <?php
      $turn = ($story['Turn']['id'] == $user['id']) ? 'turn' : null;
    ?>
    <tr<?php echo $altrow->get($turn);?>>
      <td class="avatar" style="width:100px;">
        <?php echo $avatar->user($user, true); ?>
      </td>
      <td>
        <?php if (!empty($story['Character'])):?>
        <ul>
          <?php foreach ($story['Character'] as $character): ?>
          <li style="float:left; width: 75px; text-align: center;">
          <?php echo $avatar->character($character, true);?>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>
<div style="clear:both;"></div>
<div class="actions">
  <ul>
    <?php $id = $story['Story']['id']; ?>
    <?php if ($isMember): ?>
      <li>
        <?php
          echo $html->link(
            __('Add Character', true),
            array('action' => 'add_character', $id)
          );
        ?>
      </li>
      <li>
        <?php
          echo $html->link(
            __('Remove Character', true),
            array('action' => 'remove_character', $id)
          );
        ?>
      </li>
      <li>
        <?php
          echo $html->link(__('Post an Entry', true), array(
            'controller' => 'entries', 'action' => 'add', $id
          ));
        ?>
      </li>
      <li>
        <?php
          echo $html->link(__('Leave', true), array('action' => 'leave', $id));
        ?>
      </li>
    <?php elseif($session->read('Auth.User.id')): ?>
      <li>
        <?php
          echo $html->link(__('Join', true), array('action' => 'join', $id));
        ?>
      </li>
    <?php endif; ?>
  </ul>
</div>
<?php if ($isModerator): ?>
  <div class="moderator actions">
    <ul>
      <li>
        <?php
          echo $html->link(__('Invite Member', true), array(
            'controller' => 'id',
            'action'     => 'invite',
            'moderator'  => true,
            'story_id'   => $id,
          ));
        ?>
      </li>
      <li>
        <?php
          echo $html->link(__('Edit Story Information', true), array(
            'action' => 'edit', 'moderator' => true, $id
          ));
        ?>
      </li>
      <?php if ($story['Story']['is_completed']): ?>
        <li>
          <?php
            echo $html->link(__('Mark Story as Incomplete', true), array(
              'action' => 'reopen', 'moderator' => true, $id
            ));
          ?>
        </li>
      <?php else: ?>
        <li>
          <?php
            echo $html->link(__('Mark Story as Completed', true), array(
              'action' => 'close', 'moderator' => true, $id
            ));
          ?>
        </li>
      <?php endif; ?>
      <li>
        <?php
          echo $html->link(__('Promote', true), array(
            'action' => 'promote', 'moderator' => true, $id
          ));
        ?>
      </li>
      <li>
        <?php
          echo $html->link(__('Demote', true), array(
            'action' => 'demote', 'moderator' => true, $id
          ));
        ?>
      </li>
      <li>
        <?php
          echo $html->link(__('Remove Character', true), array(
            'action' => 'remove_character', 'moderator' => true, $id
          ));
        ?>
      </li>
    </ul>
  </div>
<?php endif; ?>
</div>
