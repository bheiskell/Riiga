<div class="locations view">
<h2><?php  __('Location');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $location['Location']['name']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $location['Location']['description']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $location['Location']['parent_id']; ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('Edit Location', true),
          array('action' => 'edit', $location['Location']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('Delete Location', true),
          array('action' => 'delete', $location['Location']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $location['Location']['id']
          )
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Locations', true),
          array('action' => 'index')
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(__('New Location', true), array('action' => 'add'));
      ?>
    </li>
  </ul>
</div>
