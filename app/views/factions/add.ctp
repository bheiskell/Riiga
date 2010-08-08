<div class="factions form">
<?php echo $form->create('Faction');?>
	<fieldset>
 		<legend><?php __('Add Faction');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('Race');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Factions', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
