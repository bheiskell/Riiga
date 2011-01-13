<div class="users message">
  <?php
    echo $form->create('Message', array(
      'url'     => array(
        'action' => $this->params['action'],
        'controller' => $this->params['controller'],
      ),
    ));
  ?>
    <fieldset>
      <legend><?php __('Send message'); ?></legend>
      <?php echo $form->hidden('recv_user_id'); ?>
      <?php echo $form->input('title'); ?>
      <?php echo $form->input('message'); ?>
    </fieldset>
  <?php echo $form->end('Submit'); ?>
</div>
