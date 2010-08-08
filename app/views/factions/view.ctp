<div class="factions view">
<h2><?php  __('Faction');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faction['Faction']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faction['Faction']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Faction', true), array('action' => 'edit', $faction['Faction']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Faction', true), array('action' => 'delete', $faction['Faction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faction['Faction']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Factions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Faction', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Races');?></h3>
	<?php if (!empty($faction['Race'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Rank Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($faction['Race'] as $race):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $race['id'];?></td>
			<td><?php echo $race['name'];?></td>
			<td><?php echo $race['rank_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'races', 'action' => 'view', $race['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'races', 'action' => 'edit', $race['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'races', 'action' => 'delete', $race['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $race['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
