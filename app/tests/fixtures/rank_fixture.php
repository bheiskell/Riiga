<?php

class RankFixture extends CakeTestFixture {
	var $name = 'Rank';
	var $import = 'Rank';
	var $records = array(
		array(
			'id' => '1',
			'name' => 'Foreigner',
			'entry_count' => '0',
		),
		array(
			'id' => '2',
			'name' => 'Commoner',
			'entry_count' => '20',
		),
		array(
			'id' => '3',
			'name' => 'Citizen',
			'entry_count' => '50',
		),
		array(
			'id' => '4',
			'name' => 'Soldier',
			'entry_count' => '100',
		),
		array(
			'id' => '5',
			'name' => 'Guard',
			'entry_count' => '225',
		),
		array(
			'id' => '6',
			'name' => 'Knight',
			'entry_count' => '400',
		),
		array(
			'id' => '7',
			'name' => 'Commander',
			'entry_count' => '600',
		),
	);
}

?>
