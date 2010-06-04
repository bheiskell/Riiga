<div class="characters view">
<h2><?php  __('Character');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php
        echo $html->link($character['User']['name'], array(
            'controller' => 'users',
            'action' => 'view',
            $character['User']['id']
        ));
      ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['name']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['description']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('History'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['history']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rank'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['rank']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Wallet'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['wallet']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Race'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['race']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Faction'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['faction']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Residency'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['residency']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Profession'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['profession']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Avatar'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['avatar']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('NPC'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($character['Character']['is_npc']); ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('Edit Character', true),
          array('action' => 'edit', $character['Character']['id'])
        );
      ?>
    </li>
  </ul>
</div>
