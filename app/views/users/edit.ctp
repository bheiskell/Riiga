<div class="users form">
<?php echo $form->create('User');?>
  <fieldset>
    <legend><?php __('Edit User');?></legend>
  <?php
    echo $form->input('id');
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('password_confirm', array('type'=>'password'));
    echo $form->input('email');
    echo $form->input('url');
    echo $form->input('avatar');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
