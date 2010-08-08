<div class="factionRanks view">
<h2><?php  __('FactionRank');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $factionRank['FactionRank']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $factionRank['FactionRank']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Faction'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($factionRank['Faction']['name'], array('controller' => 'factions', 'action' => 'view', $factionRank['Faction']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rank'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($factionRank['Rank']['name'], array('controller' => 'ranks', 'action' => 'view', $factionRank['Rank']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $factionRank['FactionRank']['age']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit FactionRank', true), array('action' => 'edit', $factionRank['FactionRank']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete FactionRank', true), array('action' => 'delete', $factionRank['FactionRank']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $factionRank['FactionRank']['id'])); ?> </li>
		<li><?php echo $html->link(__('List FactionRanks', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New FactionRank', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Factions', true), array('controller' => 'factions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Faction', true), array('controller' => 'factions', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
