<h2>Dear <?php echo $recv['User']['username']; ?>:</h2>

<p>
  You have received a new message from 
  <?php
    echo $html->link($send['User']['username'], array(
      'controller' => 'users',
      'action'     => 'view',
      $send['User']['slug'],
    ));
  ?>:
</p>

<h3><?php echo h($messageTitle); ?></h3>

<?php echo $markup->parse($message); ?>

<p>
  <?php
    echo $html->link(__('Reply', true), array(
      'controller' => 'users',
      'action'     => 'view_message',
      $messageId,
    ));
  ?>
  | <?php
    echo $html->link(__('Unsubscribe', true), array(
      'controller'   => 'users',
      'action'       => 'unsubscribe',
      'id'           => $recv['User']['slug'],
      'verification' => $verification,
    ));
  ?>
</p>
