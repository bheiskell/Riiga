<div class="users index">
<h2><?php __('Members'); ?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>&nbsp;</th>
	<th><?= $paginator->sort('Member', 'username'); ?></th>
	<th><?= $paginator->sort('Homepage', 'url'); ?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
?>
	<tr<?= $class; ?>>
		<td>
			<?php 
        echo $html->image($user['User']['avatar'], array('alt'=>$user['User']['username'] . "'s avatar"));
      ?>
		<td>
			<?php echo $html->link($user['User']['username'], array('action' => 'view', $user['User']['id'])); ?>
		</td>
		<td>
			<?php if ($user['User']['url']) echo $html->link($user['User']['username'] . "'s website", $user['User']['url']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?= $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?= $paginator->numbers();?>
	<?= $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
  <?= $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% out of %count% members', true))); ?> 
</div>
