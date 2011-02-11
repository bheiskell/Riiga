<?php
class AvatarHelper extends AppHelper {

  var $helpers = array('Html');

  var $defaultMember    = 'avatar/default/member.png';
  var $defaultCharacter = 'avatar/default/character.png';

  function character($char, $show_name = false) {
    return $this->avatar(
      'character',
      $show_name,
      !empty($char['avatar']) ? $char['avatar'] : $this->defaultCharacter,
      isset($char['name'])    ? $char['name']   : 'Unknown',
      $char['id']
    );
  }

  function user($user, $show_name = false) {
    return $this->avatar(
      'user',
      $show_name,
      !empty($user['avatar'])  ? $user['avatar']   : $this->defaultMember,
      isset($user['username']) ? $user['username'] : 'Unknown',
      $user['slug']
    );
  }

  private function avatar($type, $show_name, $image, $name, $id) {
    $class = "avatar {$type}";
    $alt   = $name . "'s avatar";
    $title = $name . "'s avatar";
    $url   = array(
      'controller' => Inflector::pluralize($type),
      'action'     => 'view',
      'id'         => $id
    );

    $nameLink = ($show_name) ? $this->Html->link($name, $url) : null;

    return $this->output(
      $this->Html->div(
        $class,
        $this->Html->link(
          $this->Html->image($image, compact('alt', 'title')),
          $url,
          array(),
          false,
          false
        ) . $nameLink
      )
    );
  }
}
