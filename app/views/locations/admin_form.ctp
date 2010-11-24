<div class="locations form">
<?php echo $form->create('Location');?>
  <fieldset>
    <legend>
      <?php (isset($this->data)) ? __('Edit Location') : __('New Location'); ?>
    </legend>
  <?php
    $javascript->link('jquery/cust_select_box.js', false);
    $javascript->link('jquery/ui/location_map.js', false);
    $javascript->link('jquery/ui/location_selector.js', false);
    $javascript->link('locations/form.js', false);

    echo $form->hidden('id');
    echo $form->input('name');
    echo $form->input('description');
    echo $form->input('parent_id', array('empty' => true));
    echo $form->input('LocationTag', array(
      'empty'   => 'Add Tags',
      'between' => '<div class="select_wrap">',
      'after'   => '</div>',
    ));
    if (2 == $depth) {
      echo $form->input('LocationRegion.id');
      echo $form->input('LocationRegion.left');
      echo $form->input('LocationRegion.top');
      echo $form->input('LocationRegion.width');
      echo $form->input('LocationRegion.height');
    } else if (4 == $depth) {
      echo $form->input('LocationPoint.id');
      echo $form->input('LocationPoint.x');
      echo $form->input('LocationPoint.y');
    }
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
  <ul>
    <?php if (isset($this->data)): ?>
      <li>
        <?php
          echo $html->link(
            __('Delete', true),
            array('action' => 'delete', $form->value('Location.id')),
            null,
            sprintf(
              __('Are you sure you want to delete # %s?', true),
              $form->value('Location.id')
            )
          );
        ?>
      </li>
    <?php endif; ?>
    <li>
      <?php
        echo $html->link(
          __('List Locations', true), array('action' => 'index')
        );
      ?>
    </li>
  </ul>
</div>
<?php echo $html->image('map/riiga.jpg'); ?>
