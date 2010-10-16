<div class="stories search">
<?php echo $form->create('Story', array('action' => 'index')); ?>
  <fieldset>
    <legend><?php __('Search');?></legend>
    <?php echo $form->input('FilterUser.username'); ?>
    <?php echo $form->input('FilterCharacter.name'); ?>
    <?php echo $form->input('FilterLocation.name'); ?>
    <?php echo $form->input('Story.name'); ?>
    <?php echo $form->input('Story.is_completed', array(
      'type' => 'select', 'empty' => true, 'options' => array(
        '0' => 'incomplete',
        '1' => 'completed',
      )
    )); ?>
    <?php echo $form->input('Story.is_invite_only', array(
      'type' => 'select', 'empty' => true, 'options' => array(
        '0' => 'incomplete',
        '1' => 'completed',
      )
    )); ?>
  </fieldset>
  <?php echo $form->end('Search'); ?>
</div>
