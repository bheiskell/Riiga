<div class="users index">
  <h2><?php __('Members'); ?></h2>
  <table>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th><?php echo $paginator->sort('Member', 'username'); ?></th>
        <th><?php echo $paginator->sort('Homepage', 'url'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr<?php echo $altrow; ?>>
          <td class="avatar"><?php echo $avatar->avatar($user['User']); ?></td>
          <td>
            <?php
              echo $html->link(
                $user['User']['username'],
                array('action' => 'view', $user['User']['id'])
              );
            ?>
          </td>
          <td>
            <?php if ($user['User']['url']): ?>
              <?php
                echo $html->link(
                  $user['User']['username'] . "'s website", 
                  $user['User']['url']
                );
              ?>
            <?php else: ?>
              &nbsp;
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $this->element('pager'); ?>
</div>
