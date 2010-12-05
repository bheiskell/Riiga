<div class="stories search">
<?php echo $form->create('Story', array('action' => 'index')); ?>
  <fieldset>
    <legend><?php __('Search');?></legend>
    <?php echo $form->input('FilterUser.username', array(
      'label' => 'Member'
    )); ?>
    <?php echo $form->input('FilterCharacter.name', array(
      'label' => 'Character'
    )); ?>
    <?php echo $form->input('FilterLocation.name', array(
      'label' => 'Location'
    )); ?>
    <?php echo $form->input('Story.name', array(
      'label' => 'Story'
    )); ?>
    <?php echo $form->input('Story.is_completed', array(
      'label' => 'Completed',
      'type' => 'select',
      'empty' => true,
      'options' => array(
        '1' => 'Completed',
        '0' => 'In progress',
      )
    )); ?>
    <?php echo $form->input('Story.is_invite_only', array(
      'label' => 'Invite only',
      'type' => 'select',
      'empty' => true,
      'options' => array(
        '1' => 'Invite only',
        '0' => 'Not invite only',
      )
    )); ?>
  </fieldset>
  <?php echo $form->end('Search'); ?>
</div>
