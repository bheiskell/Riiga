<?php
class AppError extends ErrorHandler {
  /**
   * error500
   *
   * Catch all error handler.
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

    header("HTTP/1.0 500 Internal server error");
    $this->controller->set(array(
      'name' => __('500 Internal server error', true),
      'title' => __('500 Internal server error', true),
    ));

    $this->_outputMessage('error500');
  }
}
