<?php
class Rank extends AppModel {

	var $name = 'Rank';
	var $validate = array(
		'name' => array('notempty'),
		'entry_count' => array('numeric')
	);

}
?>