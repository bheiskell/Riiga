<?php

class FactionFixture extends CakeTestFixture {
  var $name = 'Faction';
  var $import = array('table' => 'factions', 'import' => false);
  var $records = array(
    array(
      'id' => '1',
      'name' => 'The Guards',
      'description' => 'A massive peace-by-order military faction controlled by General Talos, the most politically powerful man in Central. The Guards have authority over a large percentage of human countries but the order is considered a dictatorship by some. ',
    ),
    array(
      'id' => '2',
      'name' => 'The Empire',
      'description' => 'The dominant military order of Emperor Voldagen of South Ideitess. The Empire runs under four laws known as The Holy Balentias, which gives the soldiers and emperor all the power. The emperor has always been known as a tyrant, no matter who is in the throne.',
    ),
    array(
      'id' => '3',
      'name' => 'Legionites',
      'description' => 'The official military order of North Ideitess which protects the people from invasions by The Enemy. They are one of the most liked factions in Riiga, and the largest faction to have soldiers who use both weapons and magic to fight.',
    ),
    array(
      'id' => '4',
      'name' => 'Phedailin Knights',
      'description' => 'A large order with five sub-orders, each belonging to a province of North Nidonn. Phedailin Knights are generally sociable and strong, and they each follow their respective lord, who in turn follows the king of North Nidonn. ',
    ),
    array(
      'id' => '5',
      'name' => 'Carson Institute',
      'description' => 'A series of three large institutes in which students are taught to use magic either for combat or for professional purposes. The schools are heavily inspired by Sage Nicolas Carson. All high ranked members of the Institute answer to the principal.',
    ),
    array(
      'id' => '6',
      'name' => 'Order of Dualkedor',
      'description' => 'The official order of Nikina, the child god of creation. The order is centralised in the temple of Hunnuklad, where the high priest speaks with Nikina himself. Churches and temples all over the rest of Riiga spread the peaceful order\'s teachings and aid. ',
    ),
    array(
      'id' => '7',
      'name' => 'Temple Defenders',
      'description' => 'Nikina\'s warriors. The Temple Defenders are found only on Hunnuklad\'s temple grounds, and they are expertly trained guards taught to enforce order. They are guided by the chief of the temple, who answers only to the king and high priest. ',
    ),
    array(
      'id' => '8',
      'name' => 'Governmental',
      'description' => 'Any official member of the many governmental factions of Riiga. From head mayors to errandars, a government requires many positions in order to run smoothly. Though not all ranks exist in all regions of Riiga, most human countries run surprisingly similarly. ',
    ),
  );
}

?>
