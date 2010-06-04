<?php
class Entry extends AppModel {

  var $name = 'Entry';
  var $belongsTo = array(
    'Story' => array(
      'className' => 'Story',
      'foreignKey' => 'story_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  var $hasAndBelongsToMany = array(
    'Character' => array(
      'className' => 'Character',
      'joinTable' => 'characters_entries',
      'foreignKey' => 'entry_id',
      'associationForeignKey' => 'character_id',
      'unique' => true,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    )
  );

}
?>
