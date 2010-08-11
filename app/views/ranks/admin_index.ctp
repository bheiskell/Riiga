<div class="ranks index">
<h2><?php __('Ranks');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('entry_count');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($ranks as $rank):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $rank['Rank']['id']; ?>
    </td>
    <td>
      <?php echo $rank['Rank']['name']; ?>
    </td>
    <td>
      <?php echo $rank['Rank']['entry_count']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array('action' => 'view', $rank['Rank']['id'])
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array('action' => 'edit', $rank['Rank']['id'])
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $rank['Rank']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $rank['Rank']['id']
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
        echo $html->link(__('New Rank', true), array('action' => 'add'));
      ?>
    </li>
  </ul>
</div>
