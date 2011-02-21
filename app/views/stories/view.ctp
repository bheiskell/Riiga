<div class="stories view">
  <h2>
    <?php echo $story['Story']['name']; ?>
    <?php $story['Story']['is_completed']   ? __(' (Completed)')   : null; ?>
    <?php $story['Story']['is_invite_only'] ? __(' (Invite Only)') : null; ?>
  </h2>
  <?php if (!empty($entries)):?>
    <?php echo $this->element('pager'); ?>
    <table id="entries" cellpadding = "0" cellspacing = "0">
      <?php $altrow->reset(); ?>
      <?php $count = count($entries); ?>
      <?php foreach ($entries as $entry): ?>
        <?php $isDialog = ($entry['Entry']['is_dialog']) ? 'is_dialog' : null;?>
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
          <?php if (0 === --$count): ?>
            <a name="latest" class="hidden_anchor">Latest Post</a>
          <?php endif; ?>
          <a name="entry:<?php echo h($entry['Entry']['id']); ?>" class="hidden_anchor">Entry <?php echo h($entry['Entry']['id']); ?></a>
          <span class="date">
            <?php
              if ($entry['Entry']['created'] != $entry['Entry']['modified']):
            ?>
              (<?php
                echo $date->time($entry['Entry']['modified']);
              ?>)
            <?php endif; ?>
            <?php
              echo $date->time($entry['Entry']['created']);
            ?>
          </span>
          <?php echo $markup->parse($entry['Entry']['content']);?>
          </td>

          <td class="actions">
            <?php if ($isModerator || $entry['Entry']['user_id'] == $userId): ?>
              <?php
                echo $html->link(__('Edit', true), array(
                  'controller' => 'entries',
                  'action'     => 'edit',
                  'id'         => $entry['Entry']['id'],
                  'moderator'  => $isModerator,
                ), array('class' => 'ui-icon ui-icon-pencil'));
              ?>
              <?php
                echo $html->link(__('Remove', true), array(
                  'controller' => 'entries',
                  'action'     => 'remove',
                  'id'         => $entry['Entry']['id'],
                  'moderator'  => $isModerator,
                ), array('class' => 'ui-icon ui-icon-minusthick'));
              ?>
            <?php else: ?>
            <?php endif; ?>
            &nbsp;
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
  <?php endif; ?>
  <div class="related">
    <div class="location">
    <?php
      echo $minimap->render(array(
        'region' => $location['LocationRegion'],
        'point'  => $location['LocationPoint'],
      ));
    ?>
    </div>
    <?php if (!empty($users)):?>
      <table cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th><?php __('Member'); ?></th>
            <th><?php __('Characters'); ?></th>
            <?php if ($isModerator): ?>
              <th><?php __('Moderator Status'); ?></th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php $altrow->reset(); ?>
          <?php foreach ($users as $user): ?>
            <?php
              $turn = ($story['Story']['user_id_turn'] == $user['User']['id'])
                ? 'turn' : null;
            ?>
            <tr<?php echo $altrow->get($turn);?>>
              <td class="avatar<?php
                echo $user['StoriesUser']['is_deactivated']
                  ? ' deactivated': '';
              ?>">
                <?php echo $avatar->user($user['User'], true); ?>
              </td>
              <td>
                <?php
                  $user_characters = Set::extract(
                    "/Character[user_id={$user['User']['id']}]/..",
                    $characters
                  );
                ?>
                <?php if (!empty($user_characters)): ?>
                  <ul>
                    <?php foreach ($user_characters as $character): ?>
                      <li
                        <?php
                          echo $character['CharactersStory']['is_deactivated']
                            ? 'class="deactivated"' : '';
                        ?>
                      >
                        <?php
                          echo $avatar->character($character['Character'],true);
                        ?>
                        <?php
                          if (!$character['CharactersStory']['is_deactivated']
                            && ( $userId == $character['Character']['user_id']
                              || $isModerator)
                          ):
                        ?>
                          <?php
                            echo $html->link(__('Remove', true), array(
                              'action'       => 'remove_character',
                              'id'           => $story['Story']['id'],
                              'character_id' => $character['Character']['id'],
                              'moderator'    => $isModerator,
                            ), array('class' => 'ui-icon ui-icon-minusthick'));
                          ?>
                        <?php endif; ?>
                      </li>
                    <?php endforeach; ?>
                    <?php
                      if ( $userId == $user['User']['id']
                        && !$user['StoriesUser']['is_deactivated']
                      ):
                    ?>
                      <li class="add">
                        <?php
                          echo $html->link(__('Add', true), array(
                            'action' => 'add_character',
                            'id'     => $story['Story']['id'],
                          ), array('class' => 'ui-icon ui-icon-plusthick'));
                        ?>
                      </li>
                    <?php endif; ?>
                  </ul>
                <?php endif; ?>
              </td>
              <?php
                if ($isModerator && !$user['StoriesUser']['is_deactivated']):
              ?>
                <td>
                  <?php if ($user['StoriesUser']['is_moderator']): ?>
                    <?php
                      echo $html->link(__('Demote', true), array(
                        'action'    => 'demote',
                        'id'        => $story['Story']['id'],
                        'user_id'   => $user['User']['id'],
                        'moderator' => true,
                      ));
                    ?>
                  <?php else: ?>
                    <?php
                      echo $html->link(__('Promote', true), array(
                        'action'    => 'promote',
                        'id'        => $story['Story']['id'],
                        'user_id'   => $user['User']['id'],
                        'moderator' => true,
                      ));
                    ?>
                  <?php endif; ?>
                </td>
              <?php endif; ?>
            </tr>
          <tbody>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </div>
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
</div>
