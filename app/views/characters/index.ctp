<div class="characters index">
  <h2><?php __('Characters');?></h2>
  <?php if (!empty($pendingCharacters)): ?>
  <h3><?php __('Your Pending Characters');?></h3>
    <?php
      echo $this->element(
        'characters',
        array('showUser' => true, 'characters' => $pendingCharacters)
      );
    ?>
  <?php endif; ?>
  <?php echo $this->element('pager'); ?>
  <?php
    echo $this->element(
      'characters',
      array('p' => $paginator, 'showUser' => true)
    );
  ?>
  <?php echo $this->element('pager'); ?>
  <?php if ($userId): ?>
    <div class="actions">
      <ul>
        <li>
          <?php
            echo $html->link(__('New Character', true), array(
              'action' => 'add'
            ));
          ?>
        </li>
      </ul>
    </div>
  <?php endif; ?>
</div>
