<?php
class Character extends AppModel {

  var $name = 'Character';
  var $validate = array(
    'user_id'    => array('required' => false, 'allowEmpty' => false, 'rule' => array('comparison', '>=', 0)),
    'wallet'     => array('required' => true, 'allowEmpty' => false, 'rule' => array('comparison', '>=', 0)),
    'rank'       => array('required' => true, 'allowEmpty' => false, 'rule' => array('range', 0, 11)),
    'race'       => array('required' => true, 'allowEmpty' => false, 'rule' => array('maxlength', 256)),
    'faction'    => array('required' => true, 'allowEmpty' => false, 'rule' => array('maxlength', 256)),
    'residency'  => array('required' => true, 'allowEmpty' => false, 'rule' => array('maxlength', 256)),
    'profession' => array('required' => true, 'allowEmpty' => false, 'rule' => array('maxlength', 256)),
    'avatar'     => array(
      'maxlength' => array('rule' => array('maxlength', 1024)),
      'url'       => array('rule' => 'url', 'allowEmpty' => true)
    )
  );

  var $belongsTo = array('User');
}
?>
