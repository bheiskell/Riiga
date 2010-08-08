<div class="professions view">
<h2><?php  __('Profession');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $profession['Profession']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $profession['Profession']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Profession Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($profession['ProfessionCategory']['name'], array('controller' => 'profession_categories', 'action' => 'view', $profession['ProfessionCategory']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Profession', true), array('action' => 'edit', $profession['Profession']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Profession', true), array('action' => 'delete', $profession['Profession']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $profession['Profession']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Professions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Profession Categories', true), array('controller' => 'profession_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession Category', true), array('controller' => 'profession_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
