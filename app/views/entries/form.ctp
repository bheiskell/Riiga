<div class="entries form">
  <?php
    echo $form->create('Entry', array(
      'url' => $html->url(array(
        'moderator' => isset($this->params['moderator'])
                     ? $this->params['moderator'] : false
      ), true)
    ));
  ?>
  <fieldset>
    <legend>
      <?php
        echo h(sprintf(__('Entry for %s', true), $story['Story']['name']));
      ?>
    </legend>
    <?php echo $form->hidden('story_id'); ?>
    <?php echo $form->hidden('user_id'); ?>
    <?php echo $form->error('story_id'); ?>
    <?php echo $form->error('user_id'); ?>
    <?php echo $form->input('id'); ?>
    <?php echo $form->input('content'); ?>
    <?php echo $form->input('Character'); ?>
    <?php
      echo $form->input('is_dialog', array(
        'label' => __('Combat/Dialog', true)
      ));
    ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
