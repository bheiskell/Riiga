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
      'message'      => 'Valid ranks are from one to ten.'
    ),
    'race' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Race must be less than 256 characters.'
    ),
    'faction' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Faction must be less than 256 characters.'
    ),
    'residency' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Residency must be less than 256 characters.'
    ),
    'profession' => array(
      'required'     => true,
      'allowEmpty'   => false,
      'rule'         => array('maxlength', 256),
      'message'      => 'Profession must be less than 256 characters.'
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
