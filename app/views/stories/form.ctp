<div class="stories form">
<?php echo $form->create('Story');?>
  <fieldset>
    <legend>
      <?php (isset($this->data)) ? __('Edit Story') : __('Add Story'); ?>
    </legend>
  <?php $javascript->link('jquery-ui-location.js', false); ?>
  <?php $javascript->link('jquery-ui-tree_drilldown.js', false); ?>
  <?php $javascript->link('stories_form.js', false); ?>
  <?php $html->css('jquery-ui-tree_drilldown.css', null, null, false); ?>
  <?php echo $html->image('map/riiga.jpg'); ?>
  <?php
    echo $form->input('id');
    echo $form->input('name');
    // TODO: Location widget. Issue 28
    echo $form->input('Location');
    echo $form->input('User');
    echo $form->input('Character');
    echo $form->input('user_id_turn', array('options' => $turns));
    //echo $form->input('is_completed');
    echo $form->input('is_invite_only');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<script>
$().ready(function() {
  $('img[src$="riiga.jpg"]').location_map({
    width:  600,
    height: 436
  })
});
</script>
