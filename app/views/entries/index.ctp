<div class="entries index">
<h2><?php __('Entries');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('Story',  'Story.name');?></th>
  <th><?php echo $paginator->sort('Member', 'User.username');?></th>
  <th><?php echo $paginator->sort('content');?></th>
</tr>
<?php
$i = 0;
foreach ($entries as $entry):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
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
    <td><?php echo h($entry['Entry']['content']); ?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
