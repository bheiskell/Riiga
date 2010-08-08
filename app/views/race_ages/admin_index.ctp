<div class="raceAges index">
<h2><?php __('RaceAges');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('race_id');?></th>
	<th><?php echo $paginator->sort('child');?></th>
	<th><?php echo $paginator->sort('teen');?></th>
	<th><?php echo $paginator->sort('adult');?></th>
	<th><?php echo $paginator->sort('mature');?></th>
	<th><?php echo $paginator->sort('elder');?></th>
	<th><?php echo $paginator->sort('max');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($raceAges as $raceAge):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $raceAge['RaceAge']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($raceAge['Race']['name'], array('controller' => 'races', 'action' => 'view', $raceAge['Race']['id'])); ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['child']; ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['teen']; ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['adult']; ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['mature']; ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['elder']; ?>
		</td>
		<td>
			<?php echo $raceAge['RaceAge']['max']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $raceAge['RaceAge']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $raceAge['RaceAge']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $raceAge['RaceAge']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $raceAge['RaceAge']['id'])); ?>
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
		<li><?php echo $html->link(__('New RaceAge', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
