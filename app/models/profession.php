<?php
class Profession extends AppModel {

	var $name = 'Profession';
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'ProfessionCategory' => array(
			'className' => 'ProfessionCategory',
			'foreignKey' => 'profession_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>