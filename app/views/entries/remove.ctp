<div class="entries remove">
  <h2><?php __('Are you sure you want to remove this entry?'); ?></h2>
  <?php
    echo $form->create('Entry', array(
      'url' => array(
        'action'     => 'remove',
        'controller' => $this->params['controller'],
        'moderator' => !empty($this->params['moderator']),
      ),
    ));
  ?>
  <?php echo $form->input('id'); ?>
  <?php echo $form->end('Remove Entry'); ?>
</div>
