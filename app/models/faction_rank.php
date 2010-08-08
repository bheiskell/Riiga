<?php
class FactionRank extends AppModel {

	var $name = 'FactionRank';
	var $validate = array(
		'name' => array('notempty'),
		'age' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Faction' => array(
			'className' => 'Faction',
			'foreignKey' => 'faction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Rank' => array(
			'className' => 'Rank',
			'foreignKey' => 'rank_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>