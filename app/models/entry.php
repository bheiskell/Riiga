<?php
class Entry extends AppModel {

  var $name  = 'Entry';
  var $order = array('Entry.id' => 'DESC');

  var $belongsTo           = array('Story', 'User');
  var $hasAndBelongsToMany = array('Character');

  function afterSave()   { $this->clearCache(); }
  function afterDelete() { $this->clearCache(); }

  private function clearCache() {
    // This may not scale well as every time a post is made, the full cache is
    // cleared, but until profiling says otherwise, this will.
    Cache::delete('EntryCountByUserId');
  }

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
    $results = Cache::read('EntryCountByUserId');

    if (false === $results) { $results = array(); }

    if (!isset($results[$user_id])) {
      $results[$user_id] = $this->find('count', array(
        'conditions' => array('user_id' => $user_id)
      ));
      Cache::write('EntryCountByUserId', $results);
    }

    return $results[$user_id];
  }
}
?>
