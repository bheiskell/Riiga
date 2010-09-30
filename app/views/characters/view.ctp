<div class="characters view">
<h2><?php  __('Character');?></h2>
<ul class="todo">
<li>Invite to a story</li>
<li>Add to story (if owner)</li>
<li>Change character</li>
<li>Create a new story with this character</li>
<li>Show owner</li>
<li>List stories with this character</li>
<li></li>
</ul>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('History'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['history']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rank'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($character['Rank']['name'], array('controller' => 'ranks', 'action' => 'view', $character['Rank']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($character['Location']['name'], array('controller' => 'locations', 'action' => 'view', $character['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Race'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($character['Race']['name'], array('controller' => 'races', 'action' => 'view', $character['Race']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Faction'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($character['Faction']['name'], array('controller' => 'factions', 'action' => 'view', $character['Faction']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['age']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Profession'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['profession']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Avatar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['avatar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Npc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['is_npc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Deactivated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['is_deactivated']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($character['User']['username'], array('controller' => 'users', 'action' => 'view', $character['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $character['Character']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Character', true), array('action' => 'edit', $character['Character']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Character', true), array('action' => 'delete', $character['Character']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $character['Character']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Characters', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Character', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Ranks', true), array('controller' => 'ranks', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Rank', true), array('controller' => 'ranks', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Factions', true), array('controller' => 'factions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Faction', true), array('controller' => 'factions', 'action' => 'add')); ?> </li>
	</ul>
</div>
