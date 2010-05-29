<div class="stories form">
<?php echo $form->create('Story');?>
	<fieldset>
 		<legend><?php __('Add Story');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('is_invite_only');
		echo $form->input('is_completed');
		echo $form->input('is_deactivated');
		echo $form->input('location_id');
		echo $form->input('user_id_turn', array('options' => $turns));
		echo $form->input('Character');
		echo $form->input('User');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Stories', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Turn', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Entries', true), array('controller' => 'entries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Entry', true), array('controller' => 'entries', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Characters', true), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Character', true), array('controller' => 'characters', 'action' => 'add')); ?> </li>
	</ul>
</div>
