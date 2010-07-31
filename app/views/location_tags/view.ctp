<div class="locationTags view">
<h2><?php  __('LocationTag');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locationTag['LocationTag']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit LocationTag', true), array('action' => 'edit', $locationTag['LocationTag']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete LocationTag', true), array('action' => 'delete', $locationTag['LocationTag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $locationTag['LocationTag']['id'])); ?> </li>
		<li><?php echo $html->link(__('List LocationTags', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New LocationTag', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Locations');?></h3>
	<?php if (!empty($locationTag['Location'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($locationTag['Location'] as $location):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $location['id'];?></td>
			<td><?php echo $location['name'];?></td>
			<td><?php echo $location['description'];?></td>
			<td><?php echo $location['parent_id'];?></td>
			<td><?php echo $location['lft'];?></td>
			<td><?php echo $location['rght'];?></td>
			<td><?php echo $location['created'];?></td>
			<td><?php echo $location['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'locations', 'action' => 'view', $location['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'locations', 'action' => 'edit', $location['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'locations', 'action' => 'delete', $location['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $location['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
