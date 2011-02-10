<div class="pages registration_complete">
  <h2>Registration is complete! What's next?</h2>

  <p>You need a character before you can begin writing!</p>

  <?php
    $memberRanks = $html->link(__('member ranks', true), array(
      'controller' => 'ranks',
      'action'     => 'index',
    ));
  ?>
  <p>
    Every member is allowed one character per rank. So make your first
    character count. A member's rank increases as they post more entries to
    stories. For more information on ranks, read the
    <?php echo $memberRanks; ?> page.
  </p>

  <p>
    Each character is only allowed in one story at a time. However, you can
    remove your character from a story at any time. Keep in mind that
    repetitively swap a character between two stories is frowned upon.
  </p>
</div>
