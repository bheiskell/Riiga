<div class="professionsRaces index">
<h2><?php __('ProfessionsRaces');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('profession_id');?></th>
  <th><?php echo $paginator->sort('race_id');?></th>
  <th><?php echo $paginator->sort('age');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($professionsRaces as $professionsRace):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $professionsRace['ProfessionsRace']['id']; ?>
    </td>
    <td>
      <?php echo $html->link($professionsRace['Profession']['name'], array('controller' => 'professions', 'action' => 'view', $professionsRace['Profession']['id'])); ?>
    </td>
    <td>
      <?php echo $html->link($professionsRace['Race']['name'], array('controller' => 'races', 'action' => 'view', $professionsRace['Race']['id'])); ?>
    </td>
    <td>
      <?php echo $professionsRace['ProfessionsRace']['age']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $professionsRace['ProfessionsRace']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $professionsRace['ProfessionsRace']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array(
            'action' => 'delete',
            $professionsRace['ProfessionsRace']['id']
          ),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $professionsRace['ProfessionsRace']['id']
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
          __('New ProfessionsRace', true),
          array('action' => 'add')
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Professions', true),
          array('controller' => 'professions', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Profession', true),
          array('controller' => 'professions', 'action' => 'add')
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
