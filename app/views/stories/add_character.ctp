<div class="stories add_character">
  <?php
    echo $form->create('CharactersStory', array(
      'url' => array(
        'controller' => $this->params['controller'],
        'action'     => $this->params['action'],
      )
    ));
  ?>
    <fieldset>
      <legend>
        <?php
          echo sprintf(__('Add a character to "%s"', true), h($storyName));
        ?>
      </legend>
      <?php echo $form->hidden('story_id', array('value' => $storyId)); ?>
      <?php echo $form->input('character_id'); ?>
    </fieldset>
  <?php echo $form->end('Submit');?>
</div>
