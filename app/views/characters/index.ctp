<div class="characters index">
<h2><?php __('Characters');?></h2>
<?php
  echo $this->element(
    'characters',
    array('p' => $paginator, 'showUser' => true)
  );
?>
</div>
<?php echo $this->element('pager'); ?>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(__('New Character', true), array('action' => 'add'));
      ?>
    </li>
  </ul>
</div>
