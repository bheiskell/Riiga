<?php
class Character extends AppModel {

  var $name = 'Character';
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
    'description' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'Description must be between one and 4096 characters.'
    ),
    'history' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 4096),
      'message'      => 'History must be between one and 4096 characters.'
    ),
    'wallet' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('comparison', '>=', 0),
      'message'      => 'Wallet must be greater than or equal to zero.'
    ),
    'rank' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('range', 0, 11),
      'message'      => 'Valid ranks are from 1 to 10.'
    ),
    'race' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Race must be between one and 256 characters.'
    ),
    'faction' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Faction must be between one and 256 characters.'
    ),
    'residency' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Residency must be between one and 256 characters.'
    ),
    'profession' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Profession must be between one and 256 characters.'
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
    )
  );

  var $belongsTo = array('User');
}
?>
