<div class="entries form">
  <?php
    echo $form->create('Entry', array(
      'url' => $html->url(array(
        'moderator' => isset($this->params['moderator'])
                     ? $this->params['moderator'] : false
      ), true)
    ));
  ?>
  <fieldset>
    <legend>
      <?php
        echo h(sprintf(__('Entry for %s', true), $story['Story']['name']));
      ?>
    </legend>
    <?php echo $form->hidden('story_id'); ?>
    <?php echo $form->hidden('user_id'); ?>
    <?php echo $form->error('story_id'); ?>
    <?php echo $form->error('user_id'); ?>
    <?php echo $form->input('id'); ?>
    <?php echo $form->input('content'); ?>
    <h3>Why tag your characters in an entry?</h3>
    <p>
      If your character is included in the entry then you should tag them! This
      will allow their icon to show up next to the text making it clear which
      characters are in a post. This is especially handy if you have multiple
      characters (or NPCs) in a story.
    </p>
    <?php echo $form->input('Character'); ?>
    <h3>What is a combat/dialog post?</h3>
    <p>
      These are shorter post that describe what your character is saying or
      doing. By selecting this option, your avatar will be hidden and only the
      character's avatar will be displayed. This minimizes wasted space for
      shorter posts!
    </p>
    <?php
      echo $form->input('is_dialog', array(
        'label' => __('Combat/Dialog', true)
      ));
    ?>
  </fieldset>
<?php echo $form->end('Submit');?>
<?php if (!isset($this->data['Entry']['id']) && !empty($entries)): ?>
  <h3>Last Five Entries</h3>
  <table>
    <thead>
      <tr>
        <th>Entry</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($entries as $entry): ?>
        <tr<?php echo $altrow; ?>>
          <td><?php echo $markup->parse($entry['Entry']['content']); ?></td>
          <td>
            <?php echo $date->time($entry['Entry']['created']); ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
<?php endif;?>
</div>
