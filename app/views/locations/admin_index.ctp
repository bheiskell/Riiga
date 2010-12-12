<div class="locations index">
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('New Location', true), array('action' => 'add')
        );
      ?>
    </li>
  </ul>
</div>
<h2><?php __('Locations');?></h2>
<div class="tree">
<?php

  //TODO: Move this to a helper element
  printLocations($html, $locations);

  function printLocations(&$html, $locations, $i = 0) {
    if (empty($locations)) { return; }
?>
    <ul>
      <?php
        foreach ($locations as $location):
          $class = ($i++ % 2 == 0) ? ' class="altrow"' : null;
      ?>
        <li<?php echo $class?>>
          <?php echo h($location['Location']['name']); ?>
          <span class="actions">
            <?php
              echo $html->link(
                __('Up', true),
                array('action' => 'moveUp', $location['Location']['id'])
              );
            ?>
            <?php
              echo $html->link(
                __('Down', true),
                array('action' => 'moveDown', $location['Location']['id'])
              );
            ?>
            <?php
              echo $html->link(
                __('View', true),
                array('action' => 'view', $location['Location']['id'])
              );
            ?>
            <?php
              echo $html->link(
                __('Edit', true),
                array('action' => 'edit', $location['Location']['id'])
              );
            ?>
            <?php
              echo $html->link(
                __('Delete', true),
                array('action' => 'delete', $location['Location']['id']),
                null,
                sprintf(
                  __('Are you sure you want to delete # %s?', true),
                  $location['Location']['id']
                )
              );
            ?>
          </span>

          <?php printLocations($html, $location['children'], $i); ?>
        </li>
      <?php endforeach; ?>
    </ul>
<?php } ?>
</div>
</div>
