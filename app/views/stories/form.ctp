<?php $javascript->link('jquery/ui/location_info.js',  false); ?>
<?php $javascript->link('jquery/ui/location_map.js',   false); ?>
<?php $javascript->link('jquery/ui/tree_drilldown.js', false); ?>
<?php $javascript->link('jquery/ui/checkbuttons.js',   false); ?>
<?php $javascript->link('stories/form.js', false); ?>
<div class="stories form">
<?php echo $form->create('Story');?>
  <fieldset>
    <legend>
      <?php (isset($this->data)) ? __('Edit Story') : __('Add Story'); ?>
    </legend>
    <?php echo $form->input('id'); ?>
    <?php echo $form->input('name'); ?>
    <?php // TODO: Location widget. Issue 28 ?>
    <?php echo $form->input('location_id'); ?>
    <?php //echo $form->input('is_invite_only'); ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php echo $this->element('location_info', compact('locationInfo')); ?>
