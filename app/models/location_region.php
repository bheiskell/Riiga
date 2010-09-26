<?php
class LocationRegion extends AppModel {

	var $name = 'LocationRegion';
	var $validate = array(
		'location_id' => array('numeric'),
		'left' => array('numeric'),
		'top' => array('numeric'),
		'width' => array('numeric'),
		'height' => array('numeric')
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