<div class="users messages">
  <h2><?php __('Messages'); ?></h2>
  <table>
    <thead>
      <th><?php __('Member'); ?></th>
      <th><?php __('Title'); ?></th>
      <th><?php __('Date'); ?></th>
    </thead>
    <tbody>
      <?php foreach ($messages as $message): ?>
        <tr<?php echo $altrow; ?>>
          <td><?php echo $message['SendUser']['username']; ?></td>
          <td>
            <?php
              echo $html->link($message['Message']['title'], array(
                'action' => 'read_message',
                'id' => $message['Message']['id'],
              ));
            ?>
          </td>
          <td>
            <?php
              echo date('d-m-Y', strtotime($message['Message']['created']));
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
