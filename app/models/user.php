<?php
class User extends AppModel {
  var $name         = 'User';
  var $displayField = 'username';
  var $order        = array('LOWER(User.username)' => 'ASC');
  var $hasMany      = array('Character', 'Entry');

  var $validate = array(
    'username'         => array(
      'range'          => array(
        'required'     => true,
        'allowEmpty'   => false,
        'rule'         => array('maxlength', 64),
        'message'      => 'Username must be between 1 and 64 characters long.'
      ),
      'isUnique'       => array(
        'rule'         => 'isUnique',
        'message'      => 'Username is already in use. Please select another.'
      )
    ),
    'password'         => array(
      'required'       => true,
      'rule'           => array('between', 6, 128),
      'message'        => 'Passwords must be at least 6 characters long.'
    ),
    'password_confirm' => array(
      'required'       => true,
      'rule'           => array('comparePassword'),
      'message'        => 'Passwords did not match.'
    ),
    'email'            => array(
      'maxLength'      => array(
        'rule'         => array('maxlength', 320),
        'message'      => 'Email must be less than 320 characters long.'
      ),
      'email'          => array(
        'rule'         => 'email',
        'allowEmpty'   => true,
        'message'      => 'Please enter a valid email address.'
      )
    ),
    'avatar'           => array(
      'maxlength'      => array(
        'rule'         => array('maxlength', 1024),
        'message'      => 'Avatar URL must be less than 1024 characters long.'
      ),
      'url'            => array(
        'rule'         => 'url',
        'allowEmpty'   => true,
        'message'      => 'Avatar must be a valid URL'
      )
    )
  );

  /**
   * comparePassword
   *
   * Validator rule used by password_confirm.
   *
   * @access public
   * @return boolean True if passwords match
   */
  function comparePassword() {
    return $this->data['User']['password']
        == $this->data['User']['password_confirm'];
  }

  /**
   * hashPasswords
   *
   * Overload hack to prevent the Auth component from automatically hashing
   * passwords. This is needed because automatic hashing occurs before
   * validation, thus breaking checks for length and complexity.
   *
   * This function is only enabled for registration and editing. The real
   * hashing occurs in the beforeSave method.
   *
   * @param mixed   $data Data to be saved
   * @param boolean $automatic_hashing Overloaded variable to catch the call
   *                                   from the auth component
   * @access public
   * @return mixed Data
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

  /**
   * beforeValidate
   *
   * When editing their profile, a user might not reenter their password.
   *
   * @access public
   * @return void
   */
  function beforeValidate() {
    if ( isset($this->data['User']['id'])
      && empty($this->data['User']['password'])
    ) {
      unset($this->data['User']['password']);
      unset($this->validate['password']);
      unset($this->validate['password_confirm']);
    }
  }

  /**
   * beforeSave
   *
   * Perform the hashing manually and fix the user url to include http if it's
   * missing.
   *
   * @access public
   * @return void
   */
  function beforeSave() {
    $this->data = $this->hashPasswords($this->data, false);

    if (!empty($this->data['User']['url'])) {
      if (0 !== strpos($this->data['User']['url'], 'http')) {
        $this->data['User']['url'] = 'http://' .  $this->data['User']['url'];
      }
    }

    return true;
  }

  /**
   * beforeFind
   *
   * Unfortunately, the auth component doesn't support case-insensitive
   * usernames. To add support for this, while still allowing a user to
   * display set their name to a custom case, I need to intercept the queries
   * for both logging in and checking for an existing user when registering /
   * editing.
   *
   * @param mixed $query 
   * @access public
   * @return void
   */
  function beforeFind($query) {
    /* Login */
    if (isset($query['conditions']['User.username'])) {
      $query['conditions']['UPPER(User.username)'] =
        strtoupper($query['conditions']['User.username']);
      unset($query['conditions']['User.username']);
    }
    /* Registration and editing */
    if (isset($query['conditions']['or']['User.username'])) {
      $query['conditions']['or']['UPPER(User.username)'] =
        strtoupper($query['conditions']['or']['User.username']);
      unset($query['conditions']['or']['User.username']);
    }
    return $query;
  }

  /**
   * afterFind
   *
   * Assign the user's rank upon a successful find.
   *
   * @param mixed $results Results of find
   * @access public
   * @return mixed Modified results
   */
  function afterFind($results) {
    foreach ($results as &$result) {
      if ( isset($result['User'])
        && is_array($result['User'])
        && isset($result['User']['id'])
      ) {
        $result['User']['rank'] = $this->findRankById($result['User']['id']);
      }
    }
    return $results;
  }

  /**
   * findRankById
   *
   * Find the rank of a particular user id
   *
   * @param mixed $id User id
   * @access public
   * @return integer Rank of the user
   */
  function findRankById($id) {
    $score = $this->Entry->findCountByUserId($id);
    //$score += $this->findOffsetByUserId(); // TODO: score offset
    // TODO: check for admin status
    // TODO: deal with rank 0 as it will cause issues with the character wizard
         if (  0 == $score) return 0; // TODO: move to database so PM can set
    else if ( 20 >  $score) return 1; 
    else if ( 50 >  $score) return 2;
    else if (100 >  $score) return 3;
    else if (225 >  $score) return 4;
    else if (400 >  $score) return 5;
    else if (600 >  $score) return 6;
    else return 7;
  }
}
?>
