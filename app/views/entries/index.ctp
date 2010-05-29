<div class="entries index">
<h2><?php __('Entries');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('content');?></th>
	<th><?php echo $paginator->sort('is_dialog');?></th>
	<th><?php echo $paginator->sort('is_deactivated');?></th>
	<th><?php echo $paginator->sort('story_id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($entries as $entry):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo h($entry['Entry']['id']); ?>
		</td>
		<td>
			<?php echo h($entry['Entry']['content']); ?>
		</td>
		<td>
			<?php echo h($entry['Entry']['is_dialog']); ?>
		</td>
		<td>
			<?php echo h($entry['Entry']['is_deactivated']); ?>
		</td>
		<td>
			<?php echo $html->link($entry['Story']['id'], array('controller' => 'stories', 'action' => 'view', $entry['Story']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($entry['User']['id'], array('controller' => 'users', 'action' => 'view', $entry['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $entry['Entry']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $entry['Entry']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $entry['Entry']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['Entry']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Entry', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Stories', true), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Story', true), array('controller' => 'stories', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Characters', true), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Character', true), array('controller' => 'characters', 'action' => 'add')); ?> </li>
	</ul>
</div>
