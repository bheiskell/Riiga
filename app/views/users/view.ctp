<div class="users view">
<h2><?php echo h($user['User']['username']); ?></h2>
<?php
  if ($user['User']['avatar']) {
    echo $html->div('avatar',
      $html->image(
        $user['User']['avatar'],
        array('alt'=>$user['User']['username'] . "'s avatar")
      )
    );
  }
?>
<?php
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
  <?php
    echo $this->element(
      'characters',
      array('characters' => $user['Character'])
    );
  ?>
</div>
<?php endif; ?>
