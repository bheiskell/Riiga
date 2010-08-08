<?php
class ProfessionsRace extends AppModel {

	var $name = 'ProfessionsRace';
	var $validate = array(
		'age' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Profession' => array(
			'className' => 'Profession',
			'foreignKey' => 'profession_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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