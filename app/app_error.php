<?php
class AppError extends ErrorHandler {

  /**
   * error403
   *
   * Error code for when an unauthorized user hits admin or moderator resources
   *
   * @access public
   * @return void
   */
  function error403() {
    $params = $this->controller->params;

    $this->log(sprintf(
      __('%s attempted to access a restricted resource %s/%s', true),
      $this->controller->Auth->user('username'),
      $params['controller'],
      $params['action']
    ));

    header("HTTP/1.1 403 Forbidden");
    $this->controller->set(array(
      'name' => __('403 Forbidden', true),
      'title' => __('403 Forbidden', true),
    ));

    $this->_outputMessage('error403');
  }

  /**
   * error500
   *
   * Catch all error handler. Redirecting to a 404 doesn't always make sense.
   *
   * @param mixed $params
   * @access public
   * @return void
   */
  function error500($params) {
    if (isset($params['message'])) {
      $this->log($params['message']);
    }
    $this->log(Debugger::trace(), 'stacktrace');

    header("HTTP/1.1 500 Internal server error");
    $this->controller->set(array(
      'name' => __('500 Internal server error', true),
      'title' => __('500 Internal server error', true),
    ));

    $this->_outputMessage('error500');
  }
}
