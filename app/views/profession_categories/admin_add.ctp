<div class="professionCategories form">
<?php echo $form->create('ProfessionCategory');?>
	<fieldset>
 		<legend><?php __('Add ProfessionCategory');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ProfessionCategories', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Professions', true), array('controller' => 'professions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Profession', true), array('controller' => 'professions', 'action' => 'add')); ?> </li>
	</ul>
</div>
