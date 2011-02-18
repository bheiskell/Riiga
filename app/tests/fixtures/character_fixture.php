<?php

class CharacterFixture extends CakeTestFixture {
  var $name = 'Character';
  var $import = array('table' => 'characters', 'import' => false);
  var $records = array(
    array(
      'id'              => '1',
      'name'            => 'Lorem Ipsum',
      'slug'            => 'lorem_ipsum',
      'description'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer porttitor nulla ac nulla tempor laoreet. Pellentesque vel fringilla magna. Nullam viverra adipiscing tincidunt. Vestibulum congue aliquet felis, sed commodo ligula mattis quis. Integer lectus nulla, egestas ac egestas non, commodo ac eros.  Quisque enim quam, faucibus non posuere nec, luctus ac purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean vel justo ut ipsum fringilla viverra a eu metus. Suspendisse ut mi magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas semper arcu ut ultricies. Mauris massa tellus, cursus at elementum ac, sollicitudin eu nisi. Vivamus semper vestibulum enim, nec lacinia ligula condimentum eget.  Quisque sit amet ullamcorper ligula. Morbi rutrum nulla ut neque porttitor nec pretium felis tempus. Aenean sit amet egestas libero. Praesent sit amet neque ac eros facilisis sollicitudin et vitae erat. Vestibulum libero turpis, faucibus ac tristique ac, tristique et diam.',
      'history'         => 'Pellentesque sagittis, lectus sit amet gravida egestas, purus nisl scelerisque odio, quis tempor lorem felis eleifend ante. Nunc massa nunc, tincidunt id iaculis nec, porttitor sed massa. Donec blandit tristique accumsan. Suspendisse augue risus, sollicitudin et porta vitae, sollicitudin id sem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Ut consectetur cursus ligula ut euismod. Aliquam gravida placerat mi, ac iaculis tellus facilisis vel. Sed tristique, eros vel porttitor vehicula, risus ipsum ultrices eros, nec pellentesque tellus augue quis lorem. Aliquam luctus eros id nunc ullamcorper quis scelerisque nibh rhoncus. Praesent nulla urna, porta sit amet consequat eu, suscipit in mauris.',
      'rank_id'         => '1',
      'location_id'     => '4',
      'race_id'         => '1',
      'subrace_id'      => '1',
      'faction_id'      => '',
      'faction_rank_id' => '',
      'age'             => '11',
      'profession'      => 'Servant',
      'user_comment'    => '',
      'admin_comment'   => '',
      'avatar'          => '',
      'is_npc'          => '0',
      'is_deactivated'  => '0',
      'user_id'         => '1',
      'created'         => '2010-11-23 00:00:00',
      'modified'        => '2010-11-23 00:00:00',
    ),
  );
}
