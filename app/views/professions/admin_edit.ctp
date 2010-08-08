<div class="professions form">
<?php echo $form->create('Profession');?>
	<fieldset>
 		<legend><?php __('Edit Profession');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('profession_category_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Profession.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Profession.id'))); ?></li>
		<li><?php echo $html->link(__('List Professions', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Profession Categories', true), array('controller' => 'profession_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession Category', true), array('controller' => 'profession_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
