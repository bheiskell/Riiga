<div class="locationTags form">
<?php echo $form->create('LocationTag');?>
	<fieldset>
 		<legend><?php __('Edit LocationTag');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('url');
		echo $form->input('Location');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('LocationTag.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('LocationTag.id'))); ?></li>
		<li><?php echo $html->link(__('List LocationTags', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
