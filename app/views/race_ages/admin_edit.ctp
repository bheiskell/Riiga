<div class="raceAges form">
<?php echo $form->create('RaceAge');?>
	<fieldset>
 		<legend><?php __('Edit RaceAge');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('race_id');
		echo $form->input('child');
		echo $form->input('teen');
		echo $form->input('adult');
		echo $form->input('mature');
		echo $form->input('elder');
		echo $form->input('max');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('RaceAge.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('RaceAge.id'))); ?></li>
		<li><?php echo $html->link(__('List RaceAges', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
