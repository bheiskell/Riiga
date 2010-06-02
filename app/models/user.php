<?php
class User extends AppModel {
  var $displayField = 'username';

  var $name = 'User';
  var $validate = array(
    'username' => array(
      'maxlength' => array(
        'required' => true, 
        'allowEmpty' => false,
        'rule' => array('maxlength', 64)
      ),
      'isUnique' => array(
        'rule' => 'isUnique'
      )
    ),
    'password' => array(
      'required' => true,
      'rule' => array('between', 8, 128), 
      'message' => 'Passwords must be at least 8 characters long'
    ),
    'password_confirm' => array(
      'required' => true,
      'rule' => array('comparePassword'),
      'message' => 'Passwords did not match.'
    ),
    'email' => array(
      'required' => false,
      'allowEmpty' => true,
      'rule' => array('maxlength', 320)
    ),
    'avatar' => array(
      'maxlength' => array('rule' => array('maxlength', 1024)),
      'url' => array('allowEmpty' => true, 'rule' => 'url')
    )
  );

  var $hasMany = array('Character');

  /**
   * Overload hack to prevent the Auth component from automatically hashing
   * passwords. This is needed because automatic hashing occurs before
   * validation, thus breaking checks for length and complexity.
   *
   * This function is only enabled for registration and editing. The real
   * hashing occurs in the beforeSave method.
   */
  function hashPasswords($data, $automatic_hashing = true) {
    if(!$automatic_hashing && isset($data['User']['password'])) {
      /**
       * Calling the Auth component varient of this is a pain. It would involve
       * creating a helper function in the controller which just seems sloppy.
       * Instead, we call the security modules version instead.
       */
      $data['User']['password'] =
        Security::hash($data['User']['password'], null, true);
    }
    return $data;
  }

  function comparePassword() {
    return $this->data['User']['password']
        == $this->data['User']['password_confirm'];
  }

  function beforeSave() {
    $this->data = $this->hashPasswords($this->data, false);

    return true;
  }

  function afterFind($results) {
    foreach ($results as &$row) {
      if (empty($row['User']['avatar'])) {
        $row['User']['avatar'] = 'avatar/default/member.png';
      }
    }
    return $results;
  }
}
?>
