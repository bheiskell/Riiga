<?php
class MemberHelper extends AppHelper {

  var $helpers = array('Html');

  function avatar($user) {
    return $this->output(
      $this->Html->image(
        $user['avatar'],
        array('alt' => "{$user['username']}'s avatar")
      )
    );
  }

  function rank($user) {
    return $this->output("Rank");
  }

  function listCharacters($characters) {
    return $this->output("Characters");

  }
}
