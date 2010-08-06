<div class="ranks view">
<h2><?php  __('Rank');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rank['Rank']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rank['Rank']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entry Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rank['Rank']['entry_count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Rank', true), array('action' => 'edit', $rank['Rank']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Rank', true), array('action' => 'delete', $rank['Rank']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $rank['Rank']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
