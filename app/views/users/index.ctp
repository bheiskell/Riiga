<div class="users index">
  <h2><?php __('Members'); ?></h2>
  <table>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th><?php echo $paginator->sort('Member', 'username'); ?></th>
        <th><?php __('Rank'); ?></th>
        <th><?php echo $paginator->sort('Homepage', 'url'); ?></th>
        <th><?php echo $paginator->sort('joined', 'created'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr<?php echo $altrow; ?>>
          <td class="avatar user">
            <?php echo $avatar->user($user['User']); ?>
          </td>
          <td>
            <?php
              echo $html->link(
                $user['User']['username'],
                array('action' => 'view', $user['User']['id'])
              );
            ?>
          </td>
          <td>
            <?php echo $stars->render($user['User']['rank']); ?>
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
          <td>
            <?php echo date('F Y', strtotime($user['User']['created'])); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $this->element('pager'); ?>
</div>
