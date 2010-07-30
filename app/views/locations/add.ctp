<div class="locations form">
<?php echo $form->create('Location');?>
  <fieldset>
    <legend><?php __('Add Location');?></legend>
  <?php
    echo $form->input('name');
    echo $form->input('description');
    echo $form->input('parent_id', array('empty' => true));
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('List Locations', true), array('action' => 'index')
        );
      ?>
    </li>
  </ul>
</div>
