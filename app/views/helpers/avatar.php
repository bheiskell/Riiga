<?php
class AvatarHelper extends AppHelper {

  var $helpers = array('Html');

  var $def_member = 'avatar/default/member.png';
  var $def_char   = 'avatar/default/character.png';

  function avatar($array) {
    if (isset($array['username'])) {
      $img = (!empty($array['avatar'])) ? $array['avatar'] : $this->def_member;
      $alt = $array['username'] . "'s avatar";

    } else if (isset($array['name'])) {
      $img = (!empty($array['avatar'])) ? $array['avatar'] : $this->def_char;
      $alt = $array['name'] . "'s avatar";

    } else {
      $img = '';
      $alt = 'Avatar Not Found';
    }

    return $this->output($this->Html->image($img, array('alt' => $alt)));
  }
}
