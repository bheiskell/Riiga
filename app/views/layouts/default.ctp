<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?= __('Land of Riiga - ', true) . $title_for_layout ?></title>
  <?php
    echo $html->charset();
    echo $html->meta('icon');

    $css = array(
      'reset',
      'style',
      'layout',
      'form',
      'debug',
      'misc',
      'errors/403',
      'jquery/ui/ui',
      'jquery/ui/age_info',
      'jquery/ui/location_info',
      'jquery/ui/location_map',
      'jquery/ui/location_menu',
      'jquery/ui/location_selector',
      'jquery/ui/profession_info',
      'jquery/ui/selectmenu',
      'jquery/ui/selectsubmenu',
      'jquery/ui/shadow',
      'jquery/ui/star',
      'jquery/ui/tree_drilldown',
      'characters/view',
      'locations/index',
      'stories/view',
      'users/view',
    );
    foreach ($css as $file) {
      echo $html->css($file, null, null, false);
    }
    echo $javascript->link('jquery/jquery.js',          false);
    echo $javascript->link('jquery/autoresize.js',      false);
    echo $javascript->link('jquery/ui/ui.js',           false);
    echo $javascript->link('script.js',                 false);
    echo $asset->scripts_for_layout();
  ?>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><?php echo $html->link(__('Riiga', true), '/'); ?></h1>
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
