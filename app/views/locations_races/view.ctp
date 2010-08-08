<div class="locationsRaces view">
<h2><?php  __('LocationsRace');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationsRace['LocationsRace']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($locationsRace['Location']['name'], array('controller' => 'locations', 'action' => 'view', $locationsRace['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Race'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($locationsRace['Race']['name'], array('controller' => 'races', 'action' => 'view', $locationsRace['Race']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Likelihood'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationsRace['LocationsRace']['likelihood']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit LocationsRace', true), array('action' => 'edit', $locationsRace['LocationsRace']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete LocationsRace', true), array('action' => 'delete', $locationsRace['LocationsRace']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $locationsRace['LocationsRace']['id'])); ?> </li>
		<li><?php echo $html->link(__('List LocationsRaces', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New LocationsRace', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
