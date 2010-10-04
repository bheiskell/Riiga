<?php // The paginator doesn't allow param passing from the controller... ?>
<?php $paginator->options(array('url' => $this->params['named'])); ?>
<div class="stories index">
<h2><?php __('Stories');?></h2>
<ul class="todo">
<li>Filter by user, character, story name, status, invite only, location</li>
<li>Sort by, story name, last entry, creation date</li>
</ul>
<table>
<tr>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('location_id');?></th>
  <th><?php echo $paginator->sort('Turn', 'user_id_turn');?></th>
</tr>
<?php
$i = 0;
foreach ($stories as $story):
  $altrow     = ($i++ % 2 == 0)                     ? 'altrow'      : null;
  $completed  = ($story['Story']['is_completed'])   ? 'completed'   : null;
  $inviteOnly = ($story['Story']['is_invite_only']) ? 'invite_only' : null;

  $classes = trim(implode(' ', array($altrow, $completed, $inviteOnly)));
  $class = (!empty($classes)) ? " class=\"{$classes}\"" : null;
?>
  <tr<?php echo $class;?>>
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
  </ul>
</div>
