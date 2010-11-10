<?php
class Character extends AppModel {

  var $name = 'Character';
  var $order = array('UPPER(Character.name)' => 'ASC');
  var $actsAs = array('Pending');

  var $belongsTo = array('User', 'Location', 'Race', 'Rank', 'Faction');
  var $hasAndBelongsToMany = array('Story');

  var $validate = array(
    'user_id' => array(
      'required'     => false,
      'allowEmpty'   => false,
      'rule'         => array('comparison', '>=', 0),
      'message'      => 'Invalid Member'
    ),
    'name' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Name must be between one and 256 characters.'
    ),
    'race_id' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('numeric'),
      'message'      => "Specify the character's race."
    ),
    'location_id' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('numeric'),
      'message'      => "Specify the character's residency."
    ),
    'description' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'Description must be between one and 4096 characters.'
    ),
    'age' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Age must be between one and 256 characters.'
    ),
    'profession' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Profession must be between one and 256 characters.'
    ),
    'history' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'History must be between one and 4096 characters.'
    ),
    'avatar' => array(
      'maxlength' => array(
        'rule'       => array('maxlength', 1024),
        'message'    => 'Avatar must be less than 1024 characters.'
      ),
      'url' => array(
        'rule'       => 'url',
        'allowEmpty' => true,
        'message'    => 'Avatar must be a valid URL.'
      )
    ),
  );
}
?>
