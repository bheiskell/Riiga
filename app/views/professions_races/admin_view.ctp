<div class="professionsRaces view">
<h2><?php  __('ProfessionsRace');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $professionsRace['ProfessionsRace']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Profession'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($professionsRace['Profession']['name'], array('controller' => 'professions', 'action' => 'view', $professionsRace['Profession']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Race'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($professionsRace['Race']['name'], array('controller' => 'races', 'action' => 'view', $professionsRace['Race']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $professionsRace['ProfessionsRace']['age']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ProfessionsRace', true), array('action' => 'edit', $professionsRace['ProfessionsRace']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ProfessionsRace', true), array('action' => 'delete', $professionsRace['ProfessionsRace']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $professionsRace['ProfessionsRace']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ProfessionsRaces', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New ProfessionsRace', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Professions', true), array('controller' => 'professions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession', true), array('controller' => 'professions', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
