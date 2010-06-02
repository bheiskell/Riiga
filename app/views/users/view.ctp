<div class="users view">
<h2><?php echo h($user['User']['username']); ?></h2>
<?php
  echo $html->div('avatar', $riiga->avatar($user['User']));
  if ($user['User']['url']) {
    echo $html->div('website',
      $html->link(
        $user['User']['username'] . "'s website",
        $user['User']['url']
      )
    );
  }
?>
</div>
<?php if (!empty($user['Character'])):?>
<div class="related">
  <h3><?php __('Characters');?></h3>
  <?php echo $this->element('characters'); ?>
</div>
<?php endif; ?>
