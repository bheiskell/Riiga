<div class="locationTags index">
<h2><?php __('LocationTags');?></h2>
<table>
<tr>
  <th><?php echo $paginator->sort('id');?></th>
  <th><?php echo $paginator->sort('name');?></th>
  <th><?php echo $paginator->sort('description');?></th>
  <th><?php echo $paginator->sort('url');?></th>
  <th><?php echo $paginator->sort('created');?></th>
  <th><?php echo $paginator->sort('modified');?></th>
  <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($locationTags as $locationTag):
  $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null;
?>
  <tr<?php echo $class;?>>
    <td>
      <?php echo $locationTag['LocationTag']['id']; ?>
    </td>
    <td>
      <?php echo $locationTag['LocationTag']['name']; ?>
    </td>
    <td>
      <?php echo $locationTag['LocationTag']['description']; ?>
    </td>
    <td>
      <?php echo $locationTag['LocationTag']['url']; ?>
    </td>
    <td>
      <?php echo $locationTag['LocationTag']['created']; ?>
    </td>
    <td>
      <?php echo $locationTag['LocationTag']['modified']; ?>
    </td>
    <td class="actions">
      <?php
        echo $html->link(
          __('View', true),
          array(
            'action' => 'view',
            $locationTag['LocationTag']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Edit', true),
          array(
            'action' => 'edit',
            $locationTag['LocationTag']['id']
          )
        );
      ?>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $locationTag['LocationTag']['id']),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $locationTag['LocationTag']['id']
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
        echo $html->link(__('New LocationTag', true), array('action' => 'add'));
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
  </ul>
</div>
