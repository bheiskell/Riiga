<?php
class ProfessionCategory extends AppModel {

	var $name = 'ProfessionCategory';
	var $order = array('UPPER(ProfessionCategory.name)' => 'ASC');
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Profession' => array(
			'className' => 'Profession',
			'foreignKey' => 'profession_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
