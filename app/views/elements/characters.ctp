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
   */

  /* Elements are basically includes, so perform sanity checks here. */
  if ( (isset($characters) && isset($characters[0]))
    && !(isset($showUser) && $showUser && !isset($characters[0]['User']))
  ):
?>
<table>
<tr>
  <th>&nbsp;</th>
  <th><?php echo (isset($p)) ? $p->sort('name')       : __('Name');?></th>
  <th><?php echo (isset($p)) ? $p->sort('rank')       : __('Rank');?></th>
  <th><?php echo (isset($p)) ? $p->sort('race')       : __('Race');?></th>
  <th><?php echo (isset($p)) ? $p->sort('faction')    : __('Faction');?></th>
  <th><?php echo (isset($p)) ? $p->sort('residency')  : __('Residency');?></th>
  <th><?php echo (isset($p)) ? $p->sort('profession') : __('Profession');?></th>
  <?php if (isset($showUser)): ?>
    <th>
      <?php
        if (isset($p)) echo $p->sort('Member', 'User.username');
        else           echo __('Member');
      ?>
    </th>
  <?php endif; ?>
</tr>
<?php
  $i = 0;
  foreach ($characters as $character):
    $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td class="avatar">
      <?php
        echo $html->image(
          $character['Character']['avatar'], 
          array('alt' => "{$character['Character']['name']}'s avatar")
        );
      ?>
    </td>
    <td>
      <?php
        echo $html->link(
          $character['Character']['name'],
          array(
            'controller' => 'characters',
            'action'     => 'view',
            $character['Character']['id']
          )
        );
      ?>
    </td>
    <td><?php echo h($character['Character']['rank']); ?></td>
    <td><?php echo h($character['Character']['race']); ?></td>
    <td><?php echo h($character['Character']['faction']); ?></td>
    <td><?php echo h($character['Character']['residency']); ?></td>
    <td><?php echo h($character['Character']['profession']); ?></td>
    <?php if (isset($showUser) && $showUser): ?>
      <td>
        <?php
          echo $html->link(
            $character['User']['username'],
            array(
              'controller' => 'users',
              'action'     => 'view',
              $character['User']['id']
            )
          );
        ?>
      </td>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
