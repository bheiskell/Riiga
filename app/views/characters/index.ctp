<div class="characters index">
<h2><?php __('Characters');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>&nbsp;</th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('rank');?></th>
	<th><?php echo $paginator->sort('race');?></th>
	<th><?php echo $paginator->sort('faction');?></th>
	<th><?php echo $paginator->sort('residency');?></th>
	<th><?php echo $paginator->sort('profession');?></th>
	<th><?php echo $paginator->sort('Member', 'user_id');?></th>
</tr>
<?php
$i = 0;
foreach ($characters as $character):
	$class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
        echo $html->image($character['Character']['avatar'], array('alt'=>$character['Character']['name'] . "'s avatar"));
      ?>
		</td>
		<td>
			<?php echo $html->link($character['Character']['name'], array('action' => 'view', $character['Character']['id'])); ?> 
		</td>
		<td><?php echo h($character['Character']['rank']); ?></td>
		<td><?php echo h($character['Character']['race']); ?></td>
		<td><?php echo h($character['Character']['faction']); ?></td>
		<td><?php echo h($character['Character']['residency']); ?></td>
		<td><?php echo h($character['Character']['profession']); ?></td>
		<td>
			<?php echo $html->link($character['User']['username'], array('controller' => 'users', 'action' => 'view', $character['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
  <?php echo $paginator->counter(array( 'format' => __('Page %page% of %pages%, showing %current% out of %count% characters', true))); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Character', true), array('action' => 'add')); ?></li>
	</ul>
</div>
