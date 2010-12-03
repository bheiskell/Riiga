<?php
class AvatarHelper extends AppHelper {

  var $helpers = array('Html');

  var $def_member    = 'avatar/default/member.png';
  var $def_character = 'avatar/default/character.png';

  function character($char) {
    return $this->avatar(
      !empty($char['avatar']) ? $char['avatar'] : $this->def_character,
       isset($char['name'])   ? $char['name']   : 'Unknown'
    );
  }

  function user($user) {
    return $this->avatar(
      !empty($user['avatar']) ? $user['avatar']   : $this->def_member,
       isset($user['name'])   ? $user['username'] : 'Unknown'
    );
  }

  private function avatar($image, $name) {
    $alt = $name . "'s avatar";

    return $this->output($this->Html->image($image, array('alt' => $alt)));
  }
}
