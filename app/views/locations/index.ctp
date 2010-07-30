<div class="locations index">
<h2><?php __('Locations');?></h2>
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
<table cellpadding="0" cellspacing="0">
<tr>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('parent_id');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($locations as $location):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td><?php echo $location['Location']['name']; ?></td>
    <td><?php echo $location['Location']['parent_id']; ?></td>
    <td class="actions">
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
    </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->element('pager'); ?>

<?php
//TODO: Move this to a helper
printLocations($nested);

function printLocations($locations) {
  if (empty($locations)) { return; }
  echo '<ul>';
  foreach ($locations as $location) {
    echo '<li>';
    echo $location['Location']['name'];

    printLocations($location['children']);
    echo '</li>';
  }
  echo '</ul>';
}
?>

