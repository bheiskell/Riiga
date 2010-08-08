<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?= __('Land of Riiga - ', true) . $title_for_layout ?></title>
  <?php
    echo $html->charset();
    echo $html->meta('icon');
    echo $html->css('reset');
    echo $html->css('style');
    echo $html->css('jquery-ui');
    echo $javascript->link('jquery.min.js');
    echo $javascript->link('jquery-ui.min.js');
    echo $scripts_for_layout;
  ?>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><?php echo $html->link(__('Land of Riiga', true), '/'); ?></h1>
      <ul id="navigation">
        <li>
          <?php
            echo $html->link(__('Members', true), array(
              'controller' => 'users',
              'action' => 'index',
              'admin' => false,
            ));
          ?>
        </li>
        <li>
          <?php
            echo $html->link(__('Characters', true), array(
              'controller' => 'characters',
              'action' => 'index',
              'admin' => false,
            ));
          ?>
        </li>
        <li>
          <?php
            echo $html->link(__('Stories', true), array(
              'controller' => 'stories',
              'action' => 'index',
              'admin' => false,
            ));
          ?>
        </li>
      </ul>
      <ul id="account">
        <?php
          if ($session->read('Auth.User')):
            $user = $session->read('Auth.User');
        ?>
          <li>
            <?php
              echo $html->link($user['username'], array(
                'controller' => 'users',
                'action' => 'view',
                'id' => $user['id'],
                'admin' => false,
              ));
            ?>
          </li>
          <li>
            <?php
              echo $html->link(__('Logout', true), array(
                'controller' => 'users',
                'action' => 'logout',
                'admin' => false,
              ));
            ?>
          </li>
        <?php else: ?>
          <li>
            <?php
              echo $html->link(__('Register', true), array(
                'controller' => 'users',
                'action' => 'register',
                'admin' => false,
              ));
            ?>
          </li>
          <li>
            <?php
              echo $html->link(__('Login', true), array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false,
              ));
            ?>
          </li>
        <?php endif; ?>
      </ul>
      <?php echo $this->element('admin_bar'); ?>
    </div>
    <div id="content">
      <div id="flash">
        <?php $session->flash(); ?>
        <?php if ($session->check('Message.auth')) $session->flash('auth'); ?>
      </div>
      <?php echo $content_for_layout; ?>
    </div>
    <div id="footer">&nbsp;</div>
  </div>
  <?php echo $cakeDebug; ?>
</body>
</html>
