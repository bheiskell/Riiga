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
<?php if (!empty($entries)):?>
  <table id="entries" cellpadding = "0" cellspacing = "0">
    <?php $altrow->reset(); ?>
    <?php foreach ($entries as $entry): ?>
      <?php $isDialog = ($entry['Entry']['is_dialog']) ? 'is_dialog' : null; ?>
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
        <?php echo h($entry['Entry']['created']);?>
        <pre><?php echo h($entry['Entry']['content']);?></pre>
        </td>

        <td class="actions">
          <?php if ($entry['Entry']['user_id'] == $userId): ?>
            <?php
              echo $html->link(__('Edit', true), array(
                'controller' => 'entries',
                'action' => 'edit',
                $entry['Entry']['id']
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
      'region' => $location['LocationRegion'],
      'point'  => $location['LocationPoint'],
    ));
  ?>
  </div>
  <?php if (!empty($users)):?>
  <table cellpadding = "0" cellspacing = "0" style="float:left; width: 70%;">
  <tr>
    <th><?php __('Member'); ?></th>
    <th><?php __('Characters'); ?></th>
  </tr>
  <?php $altrow->reset(); ?>
  <?php foreach ($users as $user): ?>
    <?php
      $turn = ($story['Story']['user_id_turn'] == $user['User']['id']) ? 'turn' : null;
    ?>
    <tr<?php echo $altrow->get($turn);?>>
      <td class="avatar" style="width:100px;">
        <?php echo $avatar->user($user['User'], true); ?>
      </td>
      <td>
        <?php if (!empty($characters)):?>
        <ul>
          <?php foreach ($characters as $character): ?>
            <?php if ($character['Character']['user_id'] == $user['User']['id']): ?>
              <li style="float:left; width: 75px; text-align: center;">
                <?php echo $avatar->character($character['Character'], true);?>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php if ($userId == $user['User']['id']): ?>
            <li class="add">
              <?php
                echo $html->link(
                  __('+', true),
                  array('action' => 'add_character', $story['Story']['id'])
                );
              ?>
            </li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>
<div style="clear:both;"></div>
<?php if ($userId): ?>
  <div class="actions">
    <ul>
      <?php $id = $story['Story']['id']; ?>
      <?php if ($isMember): ?>
        <li>
          <?php
            echo $html->link(__('Post an Entry', true), array(
              'controller' => 'entries',
              'action'     => 'add',
              'story_id'   => $id,
            ));
          ?>
        </li>
        <li>
          <?php
            echo $html->link(
              __('Add Another Character', true),
              array('action' => 'add_character', $id)
            );
          ?>
        </li>
        <li>
          <?php
            echo $html->link(__('Leave', true), array(
              'action' => 'remove_all_characters',
              $id
            ));
          ?>
        </li>
      <?php else: ?>
        <li>
          <?php
            echo $html->link(__('Join', true), array(
              'action' => 'add_character',
              'id'     => $id,
            ));
          ?>
        </li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>
<?php if ($isModerator): ?>
  <div class="moderator actions">
    <ul>
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
    </ul>
  </div>
<?php endif; ?>
</div>
