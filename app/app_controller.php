<?php
class AppController extends Controller {
  // TODO: Activate security component
  var $view       = 'App';
  var $components = array('Auth', 'Session');
  var $helpers    = array(
    'Altrow',
    'Avatar',
    'Form',
    'Html',
    'Javascript',
    'Minimap',
    'Stars',
    'Asset.asset' => array(
      //'debug'       => -1,
      'checkTs'     => true,
      'md5FileName' => true,
      'fixCssImg'   => true,
    )
  );

  /**
   * beforeFilter
   *
   * Pre-controller processing. This allows for global checks like admin urls.
   *
   * @access public
   * @return void
   */
  function beforeFilter() {
    if (isset($this->params['admin']) && !$this->Auth->user('is_admin')) {
      $this->log(sprintf(__(
        'An unauthorized user attempted to access an admin resource: %s',
        true
      ), $this->Auth->user('is_admin')));

      $this->cakeError('error404');
    }
  }

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
