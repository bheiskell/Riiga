<div class="entries index">
<h2><?php __('Entries');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
  <th><?php echo $paginator->sort('content');?></th>
  <th><?php echo $paginator->sort('user_id');?></th>
</tr>
<?php
$i = 0;
foreach ($entries as $entry):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td><?php echo h($entry['Entry']['content']); ?></td>
    <td>
      <?php
        echo $html->link($entry['Story']['name'], array(
          'controller' => 'stories',
          'action' => 'view',
          $entry['Story']['id']
        ));
      ?>
    </td>
    <td>
      <?php
        echo $html->link($entry['User']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $entry['User']['id']
        ));
      ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
