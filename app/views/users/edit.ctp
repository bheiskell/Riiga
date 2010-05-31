<div class="users form">
<?php echo $form->create('User');?>
  <fieldset>
    <legend><?php __('Edit User');?></legend>
  <?php
    echo $form->input('id', array('type'=>'hidden'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('password_confirm', array('type'=>'password'));
    echo $form->input('email');
    echo $form->input('url');
    echo $form->input('avatar');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
  <ul>
    <li>
      <?php 
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $form->value('User.id')),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $form->value('User.id')
          )
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(__('List Users', true), array('action' => 'index'));
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Characters', true),
          array('controller' => 'characters', 'action' => 'index')
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('New Character', true),
          array('controller' => 'characters', 'action' => 'add')
        );
      ?>
    </li>
  </ul>
</div>
