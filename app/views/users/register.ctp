<div class="users form">
<?php echo $form->create('User', array('action'=>'register'));?>
  <fieldset>
    <legend><?php __('Register');?></legend>
  <?php
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('password_confirm', array('type'=>'password'));
    echo $form->input('email');
    echo $form->input('url', array('label'=>'Home Page'));
    echo $form->input('avatar');
  ?>
  </fieldset>
<?php echo $form->end('Register');?>
</div>
