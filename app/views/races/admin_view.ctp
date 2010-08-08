<div class="races view">
<h2><?php  __('Race');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $race['Race']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $race['Race']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rank'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($race['Rank']['name'], array('controller' => 'ranks', 'action' => 'view', $race['Rank']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Race', true), array('action' => 'edit', $race['Race']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Race', true), array('action' => 'delete', $race['Race']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $race['Race']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
