<?php $html->css('jquery-ui-tree_drilldown.css', null, null, false); ?>
<?php $javascript->link('jquery-ui-location.js', false); ?>
<?php $javascript->link('jquery-ui-tree_drilldown.js', false); ?>
<?php $javascript->link('stories_form.js', false); ?>
<div class="stories form">
<?php echo $form->create('Story');?>
  <fieldset>
    <legend>
      <?php (isset($this->data)) ? __('Edit Story') : __('Add Story'); ?>
    </legend>
    <?php echo $form->input('id'); ?>
    <?php echo $form->input('name'); ?>
    <?php // TODO: Location widget. Issue 28 ?>
    <?php echo $form->input('Location'); ?>
    <?php echo $form->input('User'); ?>
    <?php echo $form->input('Character'); ?>
    <?php echo $form->input('Turn'); ?>
    <?php echo $form->input('is_invite_only'); ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php echo $this->element('location_info', compact('locationInfo')); ?>
