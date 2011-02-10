<div class="users form">
  <?php echo $form->create('User', array('action'=>$this->params['action'])); ?>
    <fieldset>
      <legend>
        <?php (empty($this->data)) ? __('Register') : __('Edit Profile'); ?>
      </legend>
      <?php if (empty($this->data)): ?>
        <h3>Why should I register?</h3>
        <p>
          Riiga does not have a 'members only' section! Meaning, membership is
          not required to browse character descriptions or to read stories.
          However, registration is required if you desire to contribute, leave
          feedback, or chat.
        </p>

        <p>
          Please note that email field is not required. Every message we send
          will be through our private messaging system. However, if you provide
          an email address, we will email you a notification when you receive a
          private message.
        </p>
      <?php endif; ?>
      <?php echo $form->input('username'); ?>
      <?php echo $form->input('password'); ?>
      <?php echo $form->input('password_confirm', array('type'=>'password')); ?>
      <?php echo $form->input('email'); ?>
      <?php echo $form->input('url', array('label'=>'Home Page')); ?>
      <?php echo $form->input('avatar'); ?>
    </fieldset>
  <?php echo $form->end('Submit'); ?>
</div>
