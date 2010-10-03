<div class="users form">
  <?php echo $form->create('User'); ?>
    <fieldset>
      <legend>
        <?php (isset($this->data)) ? __('Edit Profile') : __('Register'); ?>
      </legend>
      <?php echo $form->input('username'); ?>
      <?php echo $form->input('password'); ?>
      <?php echo $form->input('password_confirm', array('type'=>'password')); ?>
      <?php echo $form->input('email'); ?>
      <?php echo $form->input('url', array('label'=>'Home Page')); ?>
      <?php echo $form->input('avatar'); ?>
    </fieldset>
  <?php echo $form->end('Submit'); ?>
</div>
