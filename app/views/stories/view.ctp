<div class="stories view">
<h2><?php
  echo $story['Story']['name'];
  echo ($story['Story']['is_completed'])   ? __(' (Completed)')   : null;
  echo ($story['Story']['is_invite_only']) ? __(' (Invite Only)') : null;
?></h2>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(__('Edit Story', true), array(
          'action' => 'edit',
          $story['Story']['id'])
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(__('New Entry', true), array(
          'controller' => 'entries',
          'action' => 'add'
        ));
      ?>
    </li>
  </ul>
</div>
<div>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo h($story['Story']['location_id']); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Turn'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php
        echo $html->link($story['Turn']['username'], array(
          'controller' => 'users',
          'action' => 'view',
          $story['Turn']['id']
        ));
      ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div>
<?php if (!empty($story['Entry'])):?>
<table cellpadding = "0" cellspacing = "0">
  <?php
    $i = 0;
    foreach ($story['Entry'] as $entry):
      $altrow   = ($i++ % 2 == 0)       ? 'altrow'    : null;
      $isDialog = ($entry['is_dialog']) ? 'is_dialog' : null;

      $classes = trim(implode(' ', array($altrow, $isDialog)));
      $class = (!empty($classes)) ? " class=\"{$classes}\"" : null;
  ?>
    <tr<?php echo $class; ?>>
      <td>
        <?php echo h($entry['User']['username']);?>
        <?php if (!empty($entry['Character'])): ?>
          <ul>
            <?php foreach ($entry['Character'] as $character): ?>
              <li><?php echo h($character['name']); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </td>
      <td><?php echo str_replace("\n", "<br/>", h($entry['content']));?></td>

      <?php if ($entry['user_id'] == $session->read('Auth.User.id')): ?>
        <td class="actions">
          <?php
            echo $html->link(__('Edit', true), array(
              'controller' => 'entries',
              'action' => 'edit',
              $entry['id']
            ));
          ?>
        </td>
      <?php endif; ?>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>

<div class="related">
  <h3><?php __('Related Users');?></h3>
  <?php if (!empty($story['User'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th>&nbsp;</th>
    <th><?php __('Username'); ?></th>
  </tr>
  <?php
    $i = 0;
    foreach ($story['User'] as $user):
      $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
    ?>
    <tr<?php echo $class;?>>
      <td><?php echo $riiga->avatar($user); ?></td>
      <td>
        <?php
          echo $html->link($user['username'], array(
            'controller' => 'users',
            'action' => 'view',
            $user['id']
          ));
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

<div class="related">
  <h3><?php __('Characters');?></h3>
  <?php if (!empty($story['Character'])):?>
  <table cellpadding = "0" cellspacing = "0">
  <tr>
    <th>&nbsp;</th>
    <th><?php __('Name'); ?></th>
    <th><?php __('Member'); ?></th>
  </tr>
  <?php
    $i = 0;
    foreach ($story['Character'] as $character):
      $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
    ?>
    <tr<?php echo $class;?>>
      <td><?php echo $riiga->avatar($character);?></td>
      <td>
        <?php
          echo $html->link($character['name'], array(
            'controller' => 'characters',
            'action' => 'view',
            $character['id']
          ));
        ?>
      </td>
      <td><?php echo h($character['User']['username']);?></td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>

</div>
