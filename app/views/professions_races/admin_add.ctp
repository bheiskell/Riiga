<div class="professionsRaces form">
<?php echo $form->create('ProfessionsRace');?>
	<fieldset>
 		<legend><?php __('Add ProfessionsRace');?></legend>
	<?php
		echo $form->input('profession_id');
		echo $form->input('race_id');
		echo $form->input('age');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ProfessionsRaces', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Professions', true), array('controller' => 'professions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession', true), array('controller' => 'professions', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
