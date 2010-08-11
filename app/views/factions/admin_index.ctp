<div class="factions index">
<h2><?php __('Factions');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('name');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($factions as $faction):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $faction['Faction']['id']; ?>
    </td>
    <td>
      <?php echo $faction['Faction']['name']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $faction['Faction']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $faction['Faction']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $faction['Faction']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $faction['Faction']['id']
          )
        );
      ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(__('New Faction', true), array('action' => 'add'));
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Races', true),
          array('controller' => 'races', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Race', true),
          array('controller' => 'races', 'action' => 'add')
        );
      ?> 
    </li>
  </ul>
</div>
