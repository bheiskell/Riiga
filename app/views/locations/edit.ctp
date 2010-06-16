<div class="locations form">
<?php echo $form->create('Location');?>
	<fieldset>
 		<legend><?php __('Edit Location');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('parent_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Location.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Location.id'))); ?></li>
		<li><?php echo $html->link(__('List Locations', true), array('action' => 'index'));?></li>
	</ul>
</div>
