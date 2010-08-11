<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
      // a (mostly) markup separated rich javascript character creation wizard.
      $javascript->link('jquery-star.js',      false);
      $javascript->link('character_wizard.js', false);

      // slightly sloppy inclusion of the user rank into the source for the
      // character creation wizard. if javascript is not enabled this isn't used
      // at all. it should not be treated as authoritative as it's client side.
      echo $form->hidden('user_rank', array('value' => $user_rank));

      echo $form->input('id');
      echo $form->input('name');
      echo $form->input('rank_id');
      echo $form->input('race_id');
      echo $form->input('location_id');
      echo 'TODO: Location is soft limited my race';
      echo $form->input('age');
      echo 'TODO: Age is adjusted by race';
      echo $form->input('faction_id', array('empty' => true));
      echo 'TODO: Display faction rank based on age and rank';
      echo $form->input('profession');
      echo 'TODO: Display profession data';
      echo $form->input('description');
      echo $form->input('history');
      echo $form->input('avatar');
      echo $form->input('is_npc');
    ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
