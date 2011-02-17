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
        <h3>Stop!</h3>
        <p>
          Did you have an existing account on the old forum? Don't create a new
          one! We'll transfer access of the old account to you! Unfortunately,
          the only way to verify your identity is for you to message Treijim
          on the <a href="http://landofriiga.proboards.com/index.cgi?action=viewprofile&user=admin">old forum</a>.
          If you have any problems, try leaving a message in the <a href="http://cbox.ws/?n=3-2503857-4717">cbox</a>.
        </p>
      <?php endif; ?>
      <?php echo $form->input('username'); ?>
      <?php echo $form->input('password'); ?>
      <?php echo $form->input('password_confirm', array('type'=>'password')); ?>
      <?php echo $form->input('email'); ?>
      <?php echo $form->input('url', array('label'=>'Home Page')); ?>
      <?php echo $form->input('avatar'); ?>
      <?php echo $form->input('receive_email'); ?>
    </fieldset>
  <?php echo $form->end('Submit'); ?>
</div>
