<div class="users index">
<h2><?php __('Members'); ?></h2>
<table>
<tr>
  <th>&nbsp;</th>
  <th><?php echo $paginator->sort('Member', 'username'); ?></th>
  <th><?php echo $paginator->sort('Homepage', 'url'); ?></th>
</tr>
<?php
  $i = 0;
  foreach ($users as $user):
    $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
?>
  <tr<?= $class; ?>>
    <td class="avatar">
      <?php echo $riiga->avatar($user['User']); ?>
    <td>
      <?php
        echo $html->link(
          $user['User']['username'],
          array('action' => 'view', $user['User']['id'])
        );
      ?>
    </td>
    <td>
      <?php
        if ($user['User']['url']) {
          echo $html->link(
            $user['User']['username'] . "'s website", 
            $user['User']['url']
          );
        } else { echo '&nbsp;'; }
    ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
