<div class="entries index">
<h2><?php __('Entries');?></h2>
<?php echo $this->element('pager'); ?>
<table>
<tr>
  <th><?php echo $paginator->sort('Story',  'Story.name');?></th>
  <th><?php echo $paginator->sort('Member', 'User.username');?></th>
  <th><?php echo $paginator->sort('content');?></th>
  <th><?php echo $paginator->sort('modified');?></th>
</tr>
<?php foreach ($entries as $entry): ?>
  <tr<?php echo $altrow;?>>
    <td>
      <?php
        echo $html->link($entry['Story']['name'], array(
          'controller' => 'stories',
          'action'     => 'view',
          'id'         => $entry['Story']['slug']
        ));
      ?>
    </td>
    <td>
      <?php
        echo $html->link($entry['User']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $entry['User']['slug']
        ));
      ?>
    </td>
    <td><?php echo h($entry['Entry']['content']); ?></td>
    <td><?php echo $date->date($entry['Entry']['modified']); ?></td>

  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
