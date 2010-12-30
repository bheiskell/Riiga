<div class="invites user">
  <?php
    echo $form->create('Invite', array(
      'url' => array('action' => $this->params['action'])
    ));
  ?>
    <fieldset>
      <legend>
        <?php
          echo sprintf(
            __('Invite a %s to a Story', true),
            h($username)
          );
        ?>
      </legend>
      <?php echo $form->input('story_id'); ?>
      <?php echo $form->hidden('user_id'); ?>
    </fieldset>
  <?php echo $form->end('Submit'); ?>
</div>
