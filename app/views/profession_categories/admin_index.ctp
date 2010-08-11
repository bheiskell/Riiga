<div class="professionCategories index">
<h2><?php __('ProfessionCategories');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('name');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($professionCategories as $professionCategory):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $professionCategory['ProfessionCategory']['id']; ?>
    </td>
    <td>
      <?php echo $professionCategory['ProfessionCategory']['name']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $professionCategory['ProfessionCategory']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $professionCategory['ProfessionCategory']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array(
            'action' => 'delete',
            $professionCategory['ProfessionCategory']['id']
          ),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $professionCategory['ProfessionCategory']['id']
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
          __('New ProfessionCategory', true),
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
  </ul>
</div>
