<div class="stories index">
<h2><?php __('Stories');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('location_id');?></th>
  <th><?php echo $paginator->sort('Turn', 'user_id_turn');?></th>
</tr>
<?php
$i = 0;
foreach ($stories as $story):
  $class = ($i++ % 2 == 0) ? $class = 'altrow' : null; 
?>
<tr<?php
  if      ($story['Story']['is_completed'])   echo " class=\"{$class} completed\"";
  else if ($story['Story']['is_invite_only']) echo " class=\"{$class} invite_only\"";
  else                                        echo " class=\"{$class}\"";
?>>
  <tr<?php echo $class;?>>
    <td><?= $html->link($story['Story']['name'], array('action' => 'view', $story['Story']['id'])); ?></td>
    <td><?php echo h($story['Story']['location_id']); ?></td>
    <td><?php echo $html->link($story['Turn']['username'], array('controller' => 'users', 'action' => 'view', $story['Turn']['id'])); ?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
  <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 |<?php echo $paginator->numbers();?>
  <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
  <?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% out of %count% stories', true))); ?>
</div>
<div class="actions">
  <ul>
    <li><?php echo $html->link(__('New Story', true), array('action' => 'add')); ?></li>
  </ul>
</div>
