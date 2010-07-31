<div class="locationTags form">
<?php echo $form->create('LocationTag');?>
	<fieldset>
 		<legend><?php __('Add LocationTag');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List LocationTags', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
