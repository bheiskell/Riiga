<div class="locationsRaces form">
<?php echo $form->create('LocationsRace');?>
	<fieldset>
		<legend><?php __('Edit LocationsRace');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('location_id');
		echo $form->input('race_id');
		echo $form->input('likelihood', array(
			'type' => 'select',
			'options' => array('Common', 'Uncommon')
		));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('LocationsRace.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('LocationsRace.id'))); ?></li>
		<li><?php echo $html->link(__('List LocationsRaces', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
