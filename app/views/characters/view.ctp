<div class="characters view">
  <h2>
    <?php echo h($character['Character']['name']);?>
    <?php if ($character['Character']['is_npc']) echo '(NPC)'; ?>
  </h2>
  <?php if ($character['Character']['avatar']): ?>
    <?php echo $html->image($character['Character']['avatar']); ?>
  <?php endif; ?>
  <table>
    <thead>
      <tr>
        <th><?php __('Rank'); ?></th>
        <th><?php __('Location'); ?></th>
        <th><?php __('Race'); ?></th>
        <th><?php __('Faction'); ?></th>
        <th><?php __('Age'); ?></th>
        <th><?php __('Profession'); ?></th>
        <th><?php __('User'); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo h($character['Rank']['id']); ?>&nbsp;</td>
        <td>
          <?php
            echo $html->link(
              $character['Location']['name'],
              array(
                'controller' => 'locations',
                'action' => 'view',
                $character['Location']['id']
              )
            );
          ?>
          &nbsp;
        </td>
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
      </tr>
    </tbody>
  </table>
  <h3><?php __('Description'); ?></h3>
  <p><?php echo h($character['Character']['description']); ?>&nbsp;</p>
  <h3><?php __('History'); ?></h3>
  <p><?php echo h($character['Character']['history']); ?>&nbsp;</p>

  <table>
    <thead><tr><th>Story</th></tr></thead>
    <tbody>
      <?php $i = 0; ?>
      <?php foreach ($character['Story'] as $story): ?>
        <tr <?php if (0 == $i++ % 2) echo 'class="altrow"';?>>
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
  <div class="actions">
    <ul>
      <li>
        <?php
          echo $html->link(
            __('Edit', true),
            array(
              'action' => 'edit',
              $character['Character']['id'],
            )
          );
        ?>
      </li>
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
    </ul>
  </div>
</div>
