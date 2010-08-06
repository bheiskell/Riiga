<div class="characterLocations view">
<h2><?php  __('CharacterLocation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $characterLocation['CharacterLocation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($characterLocation['Location']['name'], array('controller' => 'locations', 'action' => 'view', $characterLocation['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rank'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($characterLocation['Rank']['name'], array('controller' => 'ranks', 'action' => 'view', $characterLocation['Rank']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit CharacterLocation', true), array('action' => 'edit', $characterLocation['CharacterLocation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete CharacterLocation', true), array('action' => 'delete', $characterLocation['CharacterLocation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $characterLocation['CharacterLocation']['id'])); ?> </li>
		<li><?php echo $html->link(__('List CharacterLocations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New CharacterLocation', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
