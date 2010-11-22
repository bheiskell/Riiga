<div class="users login">
  <?php echo $form->create('User', array('action' => 'login')); ?>
    <fieldset>
      <legend><?php __('Login'); ?></legend>
      <?php echo $form->input('username'); ?>
      <?php echo $form->input('password'); ?>
    </fieldset>
  <?php echo $form->end('login'); ?>
</div>
