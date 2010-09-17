<div class="locations form">
<?php echo $form->create('Location');?>
  <fieldset>
    <legend><?php __('Add Location');?></legend>
  <?php
    $html->css('jquery-cust_select_box.css', null, null, false);
    $javascript->link('jquery-cust_select_box.js', false);
    $javascript->link('location_tags.js', false);

    echo $form->input('name');
    echo $form->input('description');
    echo $form->input('parent_id', array('empty' => true));
    echo $form->input('LocationTag', array(
      'empty'   => 'Add Tags',
      'between' => '<div class="select_wrap">',
      'after'   => '</div>',
    ));
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
