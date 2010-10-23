<?php
class Entry extends AppModel {

  var $name  = 'Entry';
  var $order = array('Entry.id' => 'desc');

  var $belongsTo           = array('Story', 'User');
  var $hasAndBelongsToMany = array('Character');

  /**
   * findCountByUserId
   *
   * Obtain the number of entries created by a particular user
   *
   * @param mixed $user_id User to look up
   * @access public
   * @return int Number of entries created by the user
   */
  public function findCountByUserId($user_id) {
    return $this->find('count', array(
      'conditions' => array('user_id' => $user_id)
    ));
  }
}
?>
