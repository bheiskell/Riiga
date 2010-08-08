<?php
class RaceAge extends AppModel {

	var $name = 'RaceAge';
	var $validate = array(
		'child' => array('numeric'),
		'teen' => array('numeric'),
		'adult' => array('numeric'),
		'mature' => array('numeric'),
		'elder' => array('numeric'),
		'max' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Race' => array(
			'className' => 'Race',
			'foreignKey' => 'race_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>