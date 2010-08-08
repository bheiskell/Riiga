<div class="professionCategories view">
<h2><?php  __('ProfessionCategory');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $professionCategory['ProfessionCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $professionCategory['ProfessionCategory']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ProfessionCategory', true), array('action' => 'edit', $professionCategory['ProfessionCategory']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ProfessionCategory', true), array('action' => 'delete', $professionCategory['ProfessionCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $professionCategory['ProfessionCategory']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ProfessionCategories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New ProfessionCategory', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Professions', true), array('controller' => 'professions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession', true), array('controller' => 'professions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Professions');?></h3>
	<?php if (!empty($professionCategory['Profession'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Profession Category Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($professionCategory['Profession'] as $profession):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $profession['id'];?></td>
			<td><?php echo $profession['name'];?></td>
			<td><?php echo $profession['profession_category_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'professions', 'action' => 'view', $profession['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'professions', 'action' => 'edit', $profession['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'professions', 'action' => 'delete', $profession['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $profession['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Profession', true), array('controller' => 'professions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
