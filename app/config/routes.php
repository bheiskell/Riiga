<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
Router::connect('/', array(
  'controller' => 'pages',
  'action' => 'display',
  'home',
));

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
Router::connect('/pages/*', array(
  'controller' => 'pages',
  'action' => 'display',
));

/**
 * Moderator routing for the stories controller. Reverse routing doesn't work
 * unless we're explict about id being a non-named param. We also have to
 * explicitly identify which named params are valid. This is a headache that I
 * believe is resolved in 1.3.
 */
Router::connectNamed(array('user_id', 'character_id'));
Router::connect('/moderator/:controller/:action/*', array(
  'prefix'    => 'moderator',
  'moderator' => true,
));
Router::connect('/moderator/:controller/:action/:id/*', array(
  'prefix'    => 'moderator',
  'moderator' => true,
), array(
  'id' => '[0-9]+',
));

Router::connect('/users/rss/*', array(
  'controller' => 'users',
  'action'     => 'rss',
  'url'        => array('ext' => 'rss')
));
Router::connect('/chats/rss', array(
  'controller' => 'chats',
  'action'     => 'rss',
  'url'        => array('ext' => 'rss')
));
