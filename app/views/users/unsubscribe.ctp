<div class="users unsubscribe">
  <h2><?php __('Unsubscribe from Notifications'); ?></h2>
  <p>
    When subscribed, you'll receive an email for every message sent to you.
    Unsubscribing will turn this feature off. You can re-enable this feature at
    any time by editing your profile.
  </p>
  <h3>Are you sure you want to unsubscribe?</h3>
  <?php
    echo $form->create('User', array(
      'url' => array(
        'action'       => $this->params['action'],
        'controller'   => $this->params['controller'],
        'id'           => $this->params['pass']['0'],
        'verification' => $this->params['named']['verification']
      ),
    ));
  ?>
  <?php echo $form->end('Unsubscribe from Notifications'); ?>
</div>
