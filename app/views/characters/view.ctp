<div class="characters view">
  <div class="avatar">
    <?php echo $avatar->character($character['Character']); ?>
  </div>
  <h2>
    <?php echo h($character['Character']['name']);?>
    <?php if ($character['Character']['is_npc']) echo '(NPC)'; ?>
  </h2>
  <table>
    <thead>
      <tr>
        <th><?php __('Rank'); ?></th>
        <th><?php __('Race'); ?></th>
        <th><?php __('Faction'); ?></th>
        <th><?php __('Age'); ?></th>
        <th><?php __('Profession'); ?></th>
        <th><?php __('Member'); ?></th>
        <th><?php __('Location'); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $stars->render($character['Rank']['id']); ?></td>
        <td>
          <?php echo h($character['Race']['name']); ?>
          <?php if (isset($character['Subrace']['name'])): ?>
            (<?php echo h($character['Subrace']['name']); ?>)
          <?php endif; ?>
        </td>
        <td>
          <?php if (!empty($character['Faction']['name'])): ?>
            <?php echo h($character['Faction']['name']); ?> -
            <?php echo h($character['FactionRank']['name']); ?>
          <?php endif; ?>
          &nbsp;
        </td>
        <td><?php echo h($character['Character']['age']); ?></td>
        <td><?php echo h($character['Character']['profession']); ?></td>
        <td>
          <?php
            echo $html->link(
              $character['User']['username'],
              array(
                'controller' => 'users',
                'action' => 'view',
                $character['User']['id']
              )
            );
          ?>
          &nbsp;
        </td>
        <td><?php echo h($character['Location']['name']); ?>&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <div class="map">
    <?php if (isset($character['Location']['LocationRegion'])): ?>
      <?php
        echo $minimap->render(array(
          'region' => $character['Location']['LocationRegion']
        ));
      ?>
    <?php endif; ?>
  </div>
  <h3><?php __('Description'); ?></h3>
  <pre><?php echo h($character['Character']['description']); ?>&nbsp;</pre>
  <h3><?php __('History'); ?></h3>
  <pre><?php echo h($character['Character']['history']); ?>&nbsp;</pre>

  <?php if (!empty($character['Story'])): ?>
    <table>
      <thead><tr><th>Story</th></tr></thead>
      <tbody>
        <?php foreach ($character['Story'] as $story): ?>
          <tr<?php echo $altrow;?>>
            <td>
              <?php
                echo $html->link(
                  $story['name'], array(
                    'controller' => 'stories',
                    'action' => 'view',
                    $story['id'],
                  )
                );
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
  <?php if ($userId): ?>
    <div class="actions">
      <ul>
        <li>
          <?php
            echo $html->link(
              __('Edit', true),
              array(
                'action' => 'edit',
                 $character['Character']['id'],
                'pending_id' => (isset($character['Character']['pending_id']))
                  ? $character['Character']['pending_id'] : false
              )
            );
          ?>
        </li>
        <?php if (!isset($character['Character']['pending_id'])): ?>
          <li>
            <?php if ($character['Character']['user_id'] == $userId): ?>
              <?php
                echo $html->link(
                  __('Add to a story', true),
                  array(
                    'controller' => 'story',
                    'action' => 'add_character',
                    'character_id' => $character['Character']['id'],
                  )
                );
              ?>
            <?php else: ?>
              <?php
                echo $html->link(
                  __('Invite to a story', true),
                  array(
                    'controller' => 'story',
                    'action' => 'invite',
                    'character_id' => $character['Character']['id'],
                  )
                );
              ?>
            <?php endif; ?>
          </li>
        <?php elseif ($isAdmin): ?>
          <li>
            <?php
              echo $html->link(
                __('Approve', true),
                array(
                  'action' => 'approve_pending',
                  $character['Character']['pending_id'],
                  'admin' => true,
                )
              );
            ?>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  <?php endif; ?>
</div>
