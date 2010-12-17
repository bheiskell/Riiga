<?php
class ChatsController extends AppController {
  function post() {
    if (!empty($this->data) && $this->Auth->user('id')) {
      $message = (
        $this->Chat->post(
          $this->Auth->user('id'),
          $this->data['Chat']['message']
        )
      ) ? 'Message posted' : array_shift($this->Chat->validationErrors);

    } else {
      $message = 'Failed to post message';
    }
    $this->flash($message, '/');
  }
}
