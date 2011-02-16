<div class="users view_message">
  <?php echo $avatar->user($message['SendUser'], true); ?>
  <h2><?php __('View Message'); ?></h2>
  <dl>
    <dt>Title:</dt>
    <dd><?php echo h($message['Message']['title']); ?></dd>
    <dt>From:</dt>
    <dd>
      <?php
        echo $html->link(
          $message['SendUser']['username'],
          array('action' => 'view', 'id' => $message['Message']['send_user_id'])
        );
      ?>
    </dd>
  </dl>
  <p><?php echo h($message['Message']['message']); ?></p>
  <div class="actions">
    <ul>
      <li>
        <?php
          echo $form->create('Message', array(
            'url' => array(
              'action'     => $this->params['action'],
              'controller' => $this->params['controller'],
            ),
          ));
        ?>
        <?php echo $form->input('id'); ?>
        <?php echo $form->end('Mark as Read'); ?>
      </li>
    </ul>
  </div>
</div>
