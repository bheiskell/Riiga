<?php
  /**
   * Element for display a table of characters. In the future, it might be
   * better to obtain the characters via a requestAction, and only have the
   * element includer pass in a showUser bool, a paginate bool, and an
   * optional username to limit by.
   *
   * @param array  characters Array obtained from the Character model using
   *                          find('all', ...) (required)
   * @param bool   showUser   Display owner in a member column (defaults false)
   * @param object p          Paginator object for the characters (optional)
   * @param array  options    Optional columns
   */

  /* Elements are basically includes, so perform sanity checks here. */
  if ( (isset($characters) && isset($characters[0]))
    && !(isset($showUser) && $showUser && !isset($characters[0]['User']))
  ):
?>
  <?php if (!isset($options)) { $options = array(); } ?>
  <?php if (!is_array($options)) { $options = array($options); } ?>
  <table>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <?php if (isset($p)): ?>
          <th><?php echo $p->sort('name');?></th>
          <th><?php echo $p->sort(__('Rank',      true), 'Rank.id');?></th>
          <th><?php echo $p->sort(__('Race',      true), 'Race.name');?></th>
          <th><?php echo $p->sort(__('Faction',   true), 'Faction.name');?></th>
          <th>
            <?php echo $p->sort(__('Residency', true), 'Location.name');?>
          </th>
          <th><?php echo $p->sort('profession');?></th>
          <?php if (isset($showUser)): ?>
            <th><?php echo $p->sort(__('Member', true), 'User.username');?></th>
          <?php endif; ?>
        <?php else: ?>
          <th><?php __('Name');?></th>
          <th><?php __('Rank');?></th>
          <th><?php __('Race');?></th>
          <th><?php __('Faction');?></th>
          <th><?php __('Residency');?></th>
          <th><?php __('Profession');?></th>
          <?php if (isset($showUser)): ?>
            <th><?php __('Member'); ?></th>
          <?php endif; ?>
          <?php if (in_array('current_story', $options)): ?>
            <th><?php __('Current Story'); ?></th>
          <?php endif; ?>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php $i = 0; ?>
      <?php foreach ($characters as $character): ?>
        <tr<?php echo $altrow; ?>>
          <td class="avatar character">
            <?php echo $avatar->character($character['Character']); ?>
          </td>
          <td>
            <?php if (isset($character['Character']['pending_id'])): ?>
              <?php
                echo $html->link(
                  $character['Character']['name'],
                  array(
                    'controller' => 'characters',
                    'action'     => 'view',
                    'pending_id' => $character['Character']['slug'],
                    'admin'      => false,
                  )
                );
              ?>
            <?php else: ?>
              <?php
                echo $html->link(
                  $character['Character']['name'],
                  array(
                    'controller' => 'characters',
                    'action'     => 'view',
                    'id'         => $character['Character']['slug'],
                    'admin'      => false,
                  )
                );
              ?>
            <?php endif; ?>
          </td>
          <td>
            <?php echo $stars->render($character['Rank']['id']); ?>
          </td>
          <td><?php echo h($character['Race']['name']); ?></td>
          <td><?php echo h($character['Faction']['name']); ?></td>
          <td><?php echo h($character['Location']['name']); ?></td>
          <td><?php echo h($character['Character']['profession']); ?></td>
          <?php if (isset($showUser) && $showUser): ?>
            <td>
              <?php
                echo $html->link(
                  $character['User']['username'],
                  array(
                    'controller' => 'users',
                    'action'     => 'view',
                    'id'         => $character['User']['slug'],
                    'admin'      => false,
                  )
                );
              ?>
            </td>
          <?php endif; ?>
          <?php if (in_array('current_story', $options)): ?>
            <td>
              <?php
                echo $html->link(
                  $character['CurrentStory']['name'],
                  array(
                    'controller' => 'stories',
                    'action'     => 'view',
                    'id'         => $character['CurrentStory']['slug'],
                    'admin'      => false,
                  )
                );
              ?>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
