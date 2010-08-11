<div class="locationsRaces index">
<h2><?php __('LocationsRaces');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('location_id');?></th>
  <th><?php echo $paginator->sort('race_id');?></th>
  <th><?php echo $paginator->sort('likelihood');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($locationsRaces as $locationsRace):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $locationsRace['LocationsRace']['id']; ?>
    </td>
    <td>
      <?php echo $html->link($locationsRace['Location']['name'], array('controller' => 'locations', 'action' => 'view', $locationsRace['Location']['id'])); ?>
    </td>
    <td>
      <?php echo $html->link($locationsRace['Race']['name'], array('controller' => 'races', 'action' => 'view', $locationsRace['Race']['id'])); ?>
    </td>
    <td>
      <?php echo $locationsRace['LocationsRace']['likelihood']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $locationsRace['LocationsRace']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $locationsRace['LocationsRace']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $locationsRace['LocationsRace']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $locationsRace['LocationsRace']['id']
          )
        );
      ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('New LocationsRace', true),
          array('action' => 'add')
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Locations', true),
          array('controller' => 'locations', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Location', true),
          array('controller' => 'locations', 'action' => 'add')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Races', true),
          array('controller' => 'races', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Race', true),
          array('controller' => 'races', 'action' => 'add')
        );
      ?> 
    </li>
  </ul>
</div>
