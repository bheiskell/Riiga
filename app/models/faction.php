<?php
class Faction extends AppModel {

	var $name = 'Faction';
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Race' => array(
			'className' => 'Race',
			'joinTable' => 'factions_races',
			'foreignKey' => 'faction_id',
			'associationForeignKey' => 'race_id',
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