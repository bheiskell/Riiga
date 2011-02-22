<h2>Dear <?php echo $recv['User']['username']; ?>:</h2>

<p>
  You have received a new message from 
  <?php
    echo $html->link($send['User']['username'], $html->url(array(
      'controller' => 'users',
      'action'     => 'view',
      $send['User']['slug'],
    ), true));
  ?>:
</p>

<h3><?php echo h($messageTitle); ?></h3>

<?php echo $markup->parse($message); ?>

<p>
  <?php
    echo $html->link(__('Reply', true), $html->url(array(
      'controller' => 'users',
      'action'     => 'view_message',
      $messageId,
    ), true));
  ?>
  | <?php
    echo $html->link(__('Unsubscribe', true), $html->url(array(
      'controller'   => 'users',
      'action'       => 'unsubscribe',
      'id'           => $recv['User']['slug'],
      'verification' => $verification,
    ), true));
  ?>
</p>
