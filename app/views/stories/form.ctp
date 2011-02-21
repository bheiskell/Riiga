<?php $javascript->link('jquery/ui/location_info.js',  false); ?>
<?php $javascript->link('jquery/ui/location_map.js',   false); ?>
<?php $javascript->link('jquery/ui/tree_drilldown.js', false); ?>
<?php $javascript->link('jquery/ui/checkbuttons.js',   false); ?>
<?php $javascript->link('stories/form.js', false); ?>
<div class="stories form">
<?php echo $form->create('Story', array(
  'url' => array('moderator' => isset($this->params['moderator']))
));?>
  <fieldset>
    <legend>
      <?php (isset($this->data['Story']['id'])) ? __('Edit Story') : __('Add Story'); ?>
    </legend>
    <?php echo $form->input('id'); ?>
    <?php echo $form->input('name'); ?>
    <?php // TODO: Location widget. Issue 28 ?>
    <?php echo $form->input('location_id'); ?>
    <?php //echo $form->input('is_invite_only'); ?>
    <?php if (!isset($this->data['Story']['id'])): ?>
      <?php echo $form->input('characters'); ?>
    <?php endif; ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php echo $this->element('location_info', compact('locationInfo')); ?>
