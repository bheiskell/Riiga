<div class="characters form">
<?php echo $form->create('Character');?>
	<fieldset>
 		<legend><?php __('Edit Character');?></legend>
	<?php
		echo $form->input('id');
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
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Character.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Character.id'))); ?></li>
		<li><?php echo $html->link(__('List Characters', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
