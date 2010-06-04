<div class="entries form">
<?php echo $form->create('Entry');?>
  <fieldset>
    <legend><?php __('Edit Entry');?></legend>
  <?php
    echo $form->hidden('story_id', array('value' => $story['Story']['id']));
    echo $form->input('id');
    echo $form->input('content');
    echo $form->input('is_dialog',array('label' => __('Combat/Dialog', true)));
    echo $form->input('Character');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
