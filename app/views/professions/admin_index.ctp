<div class="professions index">
<h2><?php __('Professions');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('profession_category_id');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($professions as $profession):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $profession['Profession']['id']; ?>
    </td>
    <td>
      <?php echo $profession['Profession']['name']; ?>
    </td>
    <td>
      <?php echo $html->link($profession['ProfessionCategory']['name'], array('controller' => 'profession_categories', 'action' => 'view', $profession['ProfessionCategory']['id'])); ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $profession['Profession']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $profession['Profession']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $profession['Profession']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $profession['Profession']['id']
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
        echo $html->link(__('New Profession', true), array('action' => 'add'));
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Profession Categories', true),
          array('controller' => 'profession_categories', 'action' => 'index')
        );
      ?> 
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Profession Category', true),
          array('controller' => 'profession_categories', 'action' => 'add')
        );
      ?> 
    </li>
  </ul>
</div>
