<?php // The paginator doesn't allow param passing from the controller... ?>
<?php $paginator->options(array('url' => $this->params['named'])); ?>
<div class="stories index">
<h2><?php __('Stories');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('location_id');?></th>
  <th><?php echo $paginator->sort('Turn', 'user_id_turn');?></th>
  <th><?php echo $paginator->sort('created');?></th>
  <th><?php echo $paginator->sort('Last Entry', 'LatestEntry.created');?></th>
</tr>
<?php
foreach ($stories as $story):
  $completed  = ($story['Story']['is_completed'])   ? 'completed'   : null;
  $inviteOnly = ($story['Story']['is_invite_only']) ? 'invite_only' : null;
?>
  <tr<?php echo $altrow->get($completed, $inviteOnly);?>>
    <td>
      <?php
        echo $html->link($story['Story']['name'], array(
          'action' => 'view',
          $story['Story']['id']
        ));
      ?>
    </td>
    <td><?php echo h($story['Story']['location_id']); ?></td>
    <td>
      <?php
        echo $html->link($story['Turn']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $story['Turn']['id']
        ));
      ?>
    </td>
    <td><?php echo date('F j, Y', strtotime($story['Story']['created'])); ?></td>
    <td><?php if($story['LatestEntry']['created']) echo date('F j, Y', strtotime($story['LatestEntry']['created'])); ?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(__('New Story', true), array('action' => 'add'));
      ?>
    </li>
    <li>
      <?php
        echo $html->link(__('Filter', true), array('action' => 'filter'));
      ?>
    </li>
  </ul>
</div>
