<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php

      // a (mostly) markup separated rich javascript character creation wizard.
      $javascript->link('jquery-star.js',      false);
      $javascript->link('character_wizard.js', false);

      // translate numerical ranks into strings
      $ranks = array();
      for ($i=1; $i<=10; $i++) {
        $ranks[$i] = 'Rank ' . $i;
      }

      // slightly sloppy inclusion of the user rank into the source for the
      // character creation wizard. if javascript is not enabled this isn't used
      // at all. it should not be treated as authoritative as it's client side.
      echo $form->hidden('user_rank', array('value' => 8));

      echo $form->input('id');
      echo $form->input('name');
      echo $form->input('description');
      echo $form->input('history');
      echo $form->radio('rank', $ranks);
      echo $form->input('residency');
      echo $form->input('race');
      echo $form->input('wallet');
      echo $form->input('faction');
      echo $form->input('profession');
      echo $form->input('avatar');
      echo $form->input('is_npc');
    ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
