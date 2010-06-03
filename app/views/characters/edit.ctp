<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
      echo $form->input('id');
      echo $form->input('name');
      echo $form->input('description');
      echo $form->input('history');
      echo $form->input('rank');
      echo $form->input('wallet');
      echo $form->input('race');
      echo $form->input('faction');
      echo $form->input('residency');
      echo $form->input('profession');
      echo $form->input('avatar');
      echo $form->input('is_npc');
    ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
