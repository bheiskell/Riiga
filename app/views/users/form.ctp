<div class="users form">
  <?php echo $form->create('User', array('action'=>$this->params['action'])); ?>
    <fieldset>
      <legend>
        <?php (empty($this->data)) ? __('Register') : __('Edit Profile'); ?>
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
