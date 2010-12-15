<?php // The paginator doesn't allow param passing from the controller... ?>
<?php $paginator->options(array('url' => $this->params['named'])); ?>
<div class="stories index">
<h2><?php __('Stories');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('Location', 'Location.name');?></th>
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
    <td><?php echo h($story['Location']['name']); ?></td>
    <td>
      <?php
        echo $html->link($story['Turn']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $story['Turn']['id']
        ));
      ?>
    </td>
    <td>
      <?php echo date('Y-m-d', strtotime($story['Story']['created'])); ?>
    </td>
    <td>
      <?php if ($story['LatestEntry']['created']): ?>
        <?php
          echo date('Y-m-d', strtotime($story['LatestEntry']['created']));
        ?>
      <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('pager'); ?>
<div class="actions">
  <ul>
    <?php if ($userId): ?>
      <li>
        <?php
          echo $html->link(__('New Story', true), array('action' => 'add'));
        ?>
      </li>
    <?php endif; ?>
    <li>
      <?php
        echo $html->link(__('Filter', true), array('action' => 'filter'));
      ?>
    </li>
  </ul>
</div>
</div>
