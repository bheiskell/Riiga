<?php
class AppController extends Controller {
  var $components = array('Auth', 'Session');
  var $helpers    = array('Avatar', 'Altrow', 'Html', 'Form', 'Javascript');
  var $view = 'App';

  /**
   * _isAllowed
   *
   * Central location to check if the currently authenticated user is allowed
   * to modify resources created by a particular owner.
   *
   * @param int $user_id User id that owns a given resource.
   * @access protected
   * @return boolean True if allowed
   */
  function _isAllowed($user_id) {
    return $user_id == $this->Auth->user('id') || $this->Auth->user('is_admin');
  }
}
