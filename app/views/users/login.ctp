<div class="users login">
<h2><?php __('Login'); ?></h2>
<?php
  echo $form->create('User', array('action' => 'login'));
  echo $form->input('username');
  echo $form->input('password');
  echo $form->end('login');
?>
</div>
