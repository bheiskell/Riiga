<?php
App::import('Component', 'Security');

/**
 * SecurityExtendedComponent
 *
 * I like the security component, but I don't care if a token is ancient.
 * Perpetually extends the current token on each page load. This will expire if
 * the page hasn't been loaded for seven days.
 *
 * @uses Object
 * @author Ben Heiskell <ben.heiskell@gmail.com>
 */
class SecurityExtendedComponent extends SecurityComponent {

  public function startup(&$controller) {
    if ($this->Session->check('_Token')) {
      $tokenData = unserialize($this->Session->read('_Token'));

      if (isset($tokenData['expires'])) {
        $tokenData['expires'] += 60 * 60 * 24 * 7;
      }

      $this->Session->write('_Token', serialize($tokenData));
    }
    parent::startup($controller);
  }
}
