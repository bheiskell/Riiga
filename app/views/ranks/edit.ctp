<div class="ranks form">
<?php echo $form->create('Rank');?>
	<fieldset>
 		<legend><?php __('Edit Rank');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('entry_count');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Rank.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Rank.id'))); ?></li>
		<li><?php echo $html->link(__('List Ranks', true), array('action' => 'index'));?></li>
	</ul>
</div>
