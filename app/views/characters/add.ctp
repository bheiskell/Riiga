<div class="characters form">
<?php echo $form->create('Character');?>
	<fieldset>
 		<legend><?php __('Add Character');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('history');
		echo $form->input('rank');
		echo $form->input('wallet');
		echo $form->input('race');
		echo $form->input('faction');
		echo $form->input('residency');
		echo $form->input('profession');
		echo $form->input('avatar');
		echo $form->input('is_npc');
		echo $form->input('is_deactivated');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Characters', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true),      array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true),        array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
