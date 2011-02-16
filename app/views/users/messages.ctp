<?php $javascript->link('users/view_messages.js', false); ?>
<div class="users messages">
  <?php
    echo $form->create('Message', array(
      'url'     => array(
        'action' => $this->params['action'],
        'controller' => $this->params['controller'],
      ),
    ));
  ?>
  <h2><?php __('Messages'); ?></h2>
  <table>
    <thead>
      <th>&nbsp;</th>
      <th><?php __('Member'); ?></th>
      <th><?php __('Title'); ?></th>
      <th><?php __('Date'); ?></th>
    </thead>
    <tbody>
      <?php foreach ($messages as $message): ?>
        <tr<?php echo $altrow; ?>>
          <td>
            <?php
              echo $form->checkbox(
                'Messages.' . $message['Message']['id'] . '.id',
                array('value' => $message['Message']['id'])
              );
            ?>
          </td>
          <td>
            <?php
              echo $html->link($message['SendUser']['username'], array(
                'action' => 'view',
                'id' => $message['SendUser']['slug'],
              ));
            ?>
          </td>
          <td>
            <?php
              echo $html->link($message['Message']['title'], array(
                'action' => 'view_message',
                'id' => $message['Message']['id'],
              ));
            ?>
          </td>
          <td>
            <?php
              echo date('m-d-Y', strtotime($message['Message']['created']));
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $form->end('Mark as Read'); ?>
</div>
