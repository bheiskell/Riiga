<div class="characterLocations index">
<h2><?php __('CharacterLocations');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('location_id');?></th>
  <th><?php echo $paginator->sort('rank_id');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($characterLocations as $characterLocation):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td><?php echo $characterLocation['CharacterLocation']['id']; ?></td>
    <td>
      <?php
        echo $html->link(
          $characterLocation['Location']['name'],
          array(
            'controller' => 'locations',
            'action' => 'view',
            $characterLocation['Location']['id']
          )
        );
      ?>
    </td>
    <td>
      <?php
        echo $html->link(
          $characterLocation['Rank']['name'],
          array(
            'controller' => 'ranks',
            'action' => 'view',
            $characterLocation['Rank']['id']
          )
        );
      ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $characterLocation['CharacterLocation']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $characterLocation['CharacterLocation']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array(
            'action' => 'delete',
            $characterLocation['CharacterLocation']['id']
          ),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $characterLocation['CharacterLocation']['id']
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
          __('New CharacterLocation', true),
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
          __('List Ranks', true),
          array('controller' => 'ranks', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Rank', true),
          array('controller' => 'ranks', 'action' => 'add')
        );
      ?> 
    </li>
  </ul>
</div>
