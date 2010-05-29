<div class="users view">
<h2><?php h($user['User']['username']); ?></h2>
<?php if ($user['User']['avatar']) echo $html->image($user['User']['avatar'], array('alt'=>$user['User']['username'] . "'s avatar")); ?>
<?php if ($user['User']['url']) echo $html->link($user['User']['username'] . "'s website", $user['User']['url']); ?>
</div>
<?php if (!empty($user['Character'])):?>
<div class="related">
  <h3><?php __('Characters');?></h3>
  <table>
  <tr>
    <th>&nbsp;</th>
    <th><?php __('name');?></th>
    <th><?php __('rank');?></th>
    <th><?php __('race');?></th>
    <th><?php __('faction');?></th>
    <th><?php __('residency');?></th>
    <th><?php __('profession');?></th>
  </tr>
  <?php
  $characters = $user['Character'] ;
  $i = 0;
  foreach ($characters as $character):
    $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
  ?>
    <tr<?php echo $class;?>>
      <td>
        <?php 
          echo $html->image($character['avatar'], array('alt'=>$character['name'] . "'s avatar"));
        ?>
      </td>
      <td>
        <?php echo $html->link($character['name'], array('controller' => 'characters', 'action' => 'view', $character['id'])); ?> 
      </td>
      <td>
        <?php echo h($character['rank']); ?>
      </td>
      <td>
        <?php echo h($character['race']); ?>
      </td>
      <td>
        <?php echo h($character['faction']); ?>
      </td>
      <td>
        <?php echo h($character['residency']); ?>
      </td>
      <td>
        <?php echo h($character['profession']); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
</div>
<?php endif; ?>
