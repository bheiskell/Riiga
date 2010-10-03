<div class="users login">
  <h2><?php __('Login'); ?></h2>
  <?php echo $form->create('User', array('action' => 'login')); ?>
    <?php echo $form->input('username'); ?>
    <?php echo $form->input('password'); ?>
  <?php echo $form->end('login'); ?>
</div>
