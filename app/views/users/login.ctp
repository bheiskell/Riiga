<h1>Login</h1>
<?=$form->create('User', array('action' => 'login'));?>
<?=$form->input('username');?>
<?=$form->input('password');?>
<?=$form->end('login');?>
