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
      <h3>Don't see your character here?</h3>
      <p>
        If you're trying to add a new character, be sure to wait until your
        character has been approved. If you have used the missing character
        before, be sure to remove them from their previous story. Remember,
        characters are only allowed in one story at a time.
      </p>
      <?php echo $form->hidden('story_id', array('value' => $storyId)); ?>
      <?php echo $form->input('character_id'); ?>
    </fieldset>
  <?php echo $form->end('Submit');?>
</div>
