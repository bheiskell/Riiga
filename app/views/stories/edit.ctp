<div class="stories form">
<?php echo $form->create('Story');?>
  <fieldset>
    <legend><?php __('Edit Story');?></legend>
  <?php
    echo $form->input('id');
    echo $form->input('name');
    echo $form->input('is_invite_only');
    echo $form->input('location_id');
    echo $form->input('User');
    echo $form->input('Character');
    echo $form->input('user_id_turn', array('options' => $turns));
    echo $form->input('is_completed');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
