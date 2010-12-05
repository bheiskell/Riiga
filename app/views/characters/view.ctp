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
          <?php
            echo $html->link(
              $character['Race']['name'],
              array(
                'controller' => 'races',
                'action' => 'view',
                $character['Race']['id']
              )
            );
          ?>
          &nbsp;
        </td>
        <td>
          <?php
            echo $html->link(
              $character['Faction']['name'],
              array(
                'controller' => 'factions',
                'action' => 'view',
                $character['Faction']['id']
              )
            );
          ?>
          &nbsp;
        </td>
        <td><?php echo h($character['Character']['age']); ?>&nbsp;</td>
        <td><?php echo h($character['Character']['profession']); ?>&nbsp;</td>
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
        echo $minimap->render(
          $character['Location']['LocationRegion']['left'],
          $character['Location']['LocationRegion']['top'],
          $character['Location']['LocationRegion']['width'],
          $character['Location']['LocationRegion']['height']
        );
      ?>
    <?php endif; ?>
  </div>
  <h3><?php __('Description'); ?></h3>
  <p><?php echo h($character['Character']['description']); ?>&nbsp;</p>
  <h3><?php __('History'); ?></h3>
  <p><?php echo h($character['Character']['history']); ?>&nbsp;</p>

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
          <?php
            if (
            $character['Character']['user_id'] == $session->read('Auth.User.id')
            ):
          ?>
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
</div>
