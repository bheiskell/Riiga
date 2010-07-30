<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php

      // a (mostly) markup separated rich javascript character creation wizard.
      $javascript->link('jquery-star.js',      false);
      $javascript->link('character_wizard.js', false);

// Move this to a model or something. Doesn't belong in the view. //////////////

  // translate numerical ranks into strings
  $ranks = array();
  for ($i=1; $i<=10; $i++) {
    $ranks[$i] = 'Rank ' . $i;
  }

  // form friendly residencies list
  $residencies = array(
    'Rank 1' => array(
      'North Tasif'    => 'North Tasif',
      'South Tasif'    => 'South Tasif',
      'Temanea'        => 'Temanea',
      'Huirnon'        => 'Huirnon',
      'North Ideitess' => 'North Ideitess',
      'South Ideitess' => 'South Ideitess',
      'Curin'          => 'Curin',
      'North Nidonn'   => 'North Nidonn',
    ),
    'Rank 2' => array(
      'Estall Bay' => 'Estall Bay',
      'Jindiara'   => 'Jindiara',
    ),
    'Rank 3' => array(
      'Ketrem'   => 'Ketrem',
      'Tekrikri' => 'Tekrikri',
    ),
    'Rank 4' => array(
      'Iyakel' => 'Iyakel',
    ),
    'Rank 5' => array(
      'South Nidonn' => 'South Nidonn',
      'Evealdinn'    => 'Evealdinn',
    ),
    'Rank 6' => array(
      'Yanuiri' => 'Yanuiri',
    ),
    'Rank 7' => array(
      'Central Ideitess' => 'Central Ideitess',
    ),
  );

  $races = array(
    'Human'     => 'Human',
    'Ildemin'   => 'Ildemin',
    'Keid'      => 'Keid',
    'Gruitin'   => 'Gruitin',
    'Sirin'     => 'Sirin',
    'Modeoa'    => 'Modeoa',
    'Fanoran'   => 'Fanoran',
    'Trueblood' => 'Trueblood',
    'Karithian' => 'Karithian',
    'Cullashin' => 'Cullashin',
    'Hamakro'   => 'Hamakro',
  );

////////////////////////////////////////////////////////////////////////////////

      // slightly sloppy inclusion of the user rank into the source for the
      // character creation wizard. if javascript is not enabled this isn't used
      // at all. it should not be treated as authoritative as it's client side.
      echo $form->hidden('user_rank', array('value' => 8));

      echo $form->input('id');
      echo $form->input('name');
      echo $form->input('description');
      echo $form->input('history');
      echo $form->radio('rank', $ranks);
      echo $form->input('race', array(
        'type'    => 'select',
        'options' => $races
      ));
      echo $form->input('residency', array(
        'type'    => 'select',
        'options' => $residencies
      ));
      echo $form->input('wallet');
      echo $form->input('faction');
      echo $form->input('profession');
      echo $form->input('avatar');
      echo $form->input('is_npc');
    ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
