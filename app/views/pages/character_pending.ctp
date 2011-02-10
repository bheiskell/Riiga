<div class="pages character_pending">
  <h2>Your character has been submitted for approval!</h2>

  <p>
    An administrator will either approve your character or suggest alterations.
    These suggestions are not intended to stifle your creativity. Instead, the
    goal is to help your character better fit into Riiga.
  </p>
  <?php
    $stories = $html->link(__('stories', true), array(
      'controller' => 'stories',
      'view'       => 'index'
    ));
  ?>
  <p>
    In the meantime, explore the existing <?php echo $stories; ?>. Although you
    are allowed to join any open story, it's recommended to contact the story's
    authors before contributing. This can be accomplished via private message or
    the chat box below.
  </p>
</div>
