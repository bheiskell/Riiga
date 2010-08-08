<div class="characterLocations form">
<?php echo $form->create('CharacterLocation');?>
	<fieldset>
 		<legend><?php __('Edit CharacterLocation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('location_id');
		echo $form->input('rank_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('CharacterLocation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('CharacterLocation.id'))); ?></li>
		<li><?php echo $html->link(__('List CharacterLocations', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
	</ul>
</div>
