<div class="factionRanks form">
<?php echo $form->create('FactionRank');?>
	<fieldset>
 		<legend><?php __('Edit FactionRank');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('faction_id');
		echo $form->input('rank_id');
		echo $form->input('age');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('FactionRank.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('FactionRank.id'))); ?></li>
		<li><?php echo $html->link(__('List FactionRanks', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Factions', true), array('controller' => 'factions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Faction', true), array('controller' => 'factions', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
