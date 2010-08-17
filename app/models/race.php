<?php
class Race extends AppModel {

  var $name = 'Race';
  var $validate = array(
    'name' => array('notempty')
  );

  var $belongsTo = array('Rank');

  /* Overloading find to offer grouped results to the controller */
  public function find(
    $conditions = NULL, $fields = array(), $order = NULL, $recursive = NULL
  ) {
    if ('grouped' == $conditions) {
      $results = $this->find('list',
        array(
          'fields' => array('id', 'name', 'rank_id'),
          'order'  => array('rank_id'),
        )
      );

      /* Group by rank prefixed with rank */
      foreach(array_keys($results) as $key) {
        $results["Rank {$key}"] = $results[$key];
        unset($results[$key]);
      }

      return $results;
    } else {
      return parent::find($conditions, $fields, $order, $recursive);
    }
  }
}
?>
