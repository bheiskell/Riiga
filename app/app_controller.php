<?php
class AppController extends Controller {
  var $components = array('Auth', 'Session');
  var $helpers    = array('Avatar', 'Altrow', 'Html', 'Form', 'Javascript');
  var $view = 'App';
}
