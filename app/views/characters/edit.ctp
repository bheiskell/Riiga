<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
      echo $form->input('id');
      echo $form->input('name');
      echo $form->input('description');
      echo $form->input('history');
      echo $form->radio(
        'rank',
        array(
          1  => 'Rank 1',
          2  => 'Rank 2',
          3  => 'Rank 3',
          4  => 'Rank 4',
          5  => 'Rank 5',
          6  => 'Rank 6',
          7  => 'Rank 7',
          8  => 'Rank 8',
          9  => 'Rank 9',
          10 => 'Rank 10',
        ), array('legend' => 'rank')
      );
      echo $form->input('residency');
      echo $form->input('race');
      echo $form->input('wallet');
      echo $form->input('faction');
      echo $form->input('profession');
      echo $form->input('avatar');
      echo $form->input('is_npc');

      $javascript->link('jquery-star.js', false);
      echo $javascript->codeBlock('
        // inline javascript... ewwww. 
        $(document).ready(function() {
          $(":radio:first").parent().star({
            valueLimit: ' . 8 /* TODO */ . ',
            disabledMessage: " exceeds your current rank"
          });
        });
      ');
    ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
