<?php
class LocationPoint extends AppModel {

	var $name = 'LocationPoint';
	var $validate = array(
		'location_id' => array('numeric'),
		'x' => array('numeric'),
		'y' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>