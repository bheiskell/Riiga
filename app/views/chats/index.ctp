<div class="chats index">
  <h2><?php __('Chat Box');?></h2>
  <?php echo $this->element('pager'); ?>
  <table>
    <thead>
      <tr>
        <th><?php __('Member'); ?></th>
        <th><?php __('Message');?></th>
        <th><?php echo $paginator->sort('created');?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($chats as $chat): ?>
        <tr<?php echo $altrow?>>
          <td><?php echo h($chat['User']['username']); ?></td>
          <td><?php echo h($chat['Chat']['message']); ?></td>
          <td><?php echo h($chat['Chat']['created']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $this->element('pager'); ?>
</div>
