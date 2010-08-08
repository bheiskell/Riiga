<div class="factionRanks index">
<h2><?php __('FactionRanks');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('faction_id');?></th>
	<th><?php echo $paginator->sort('rank_id');?></th>
	<th><?php echo $paginator->sort('age');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($factionRanks as $factionRank):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $factionRank['FactionRank']['id']; ?>
		</td>
		<td>
			<?php echo $factionRank['FactionRank']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($factionRank['Faction']['name'], array('controller' => 'factions', 'action' => 'view', $factionRank['Faction']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($factionRank['Rank']['name'], array('controller' => 'ranks', 'action' => 'view', $factionRank['Rank']['id'])); ?>
		</td>
		<td>
			<?php echo $factionRank['FactionRank']['age']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $factionRank['FactionRank']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $factionRank['FactionRank']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $factionRank['FactionRank']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $factionRank['FactionRank']['id'])); ?>
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
		<li><?php echo $html->link(__('New FactionRank', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Factions', true), array('controller' => 'factions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Faction', true), array('controller' => 'factions', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
