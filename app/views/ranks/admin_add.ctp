<div class="ranks form">
<?php echo $form->create('Rank');?>
	<fieldset>
 		<legend><?php __('Add Rank');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('entry_count');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Ranks', true), array('action' => 'index'));?></li>
	</ul>
</div>
