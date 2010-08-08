<div class="races form">
<?php echo $form->create('Race');?>
	<fieldset>
 		<legend><?php __('Edit Race');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('rank_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Race.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Race.id'))); ?></li>
		<li><?php echo $html->link(__('List Races', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
