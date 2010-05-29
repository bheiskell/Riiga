<div class="entries form">
<?php echo $form->create('Entry');?>
	<fieldset>
 		<legend><?php __('Edit Entry');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('content');
		echo $form->input('is_dialog');
		echo $form->input('is_deactivated');
		echo $form->input('story_id');
		echo $form->input('user_id');
		echo $form->input('Character');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Entry.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Entry.id'))); ?></li>
		<li><?php echo $html->link(__('List Entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Stories', true), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Story', true), array('controller' => 'stories', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Characters', true), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Character', true), array('controller' => 'characters', 'action' => 'add')); ?> </li>
	</ul>
</div>
