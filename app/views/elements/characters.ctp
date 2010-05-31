<?php
/**
 * @param array  characters Characters array
 * @param bool   showUser   Display user column (defaults false)
 * @param array  user       Users array (optional)
 * @param object p          Paginator object (optional)
 */
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
        if (isset($p)) {
          echo $p->sort('Member', 'User.username');
        } else {
          echo __('Member');
        }
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
          array('alt' => $character['Character']['name'] . "'s avatar")
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
    <?php if (isset($showUser)): ?>
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
      </td>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
</table>
