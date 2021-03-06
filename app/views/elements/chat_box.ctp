<?php
  // Automagic form elements pull from the view directly for thier input. This
  // means if messages is set, like in the messages action of the user
  // controller, the input box will be populated with incorrect data.
  $this->set('messages', false);
?>
<? if (isset($footerChats)): ?>
  <div class="chat_box">
    <?php if (!empty($footerChats)): ?>
    <p>
      <?php
        echo $html->link(__('View all Chats', true), array(
          'controller' => 'chats',
          'action' => 'index',
        ));
      ?>
    </p>
    <table>
      <tbody>
        <?php $altrow->reset(); ?>
        <?php foreach ($footerChats as $chat): ?>
          <tr<?php echo $altrow; ?>>
            <td>
              <?php
                echo $html->link($chat['User']['username'], array(
                  'controller' => 'users',
                  'action' => 'view',
                  'id' => $chat['User']['slug']
                ));
              ?>
            </td>
            <td><?php echo $markup->parse($chat['Chat']['message']); ?></td>
            <td>
              <?php echo $date->date($chat['Chat']['created']); ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
    <?php if ($userId): ?>
      <?php
        echo $form->create('Chat', array(
          'controller' => 'chats',
          'action'     => 'post',
        ));
      ?>
      <?php echo $form->input('message'); ?>
      <?php echo $form->end('Submit'); ?>
    <?php else: ?>
      <p>
        <?php
          echo $html->link(__('Login', true), array(
            'controller' => 'users',
            'action' => 'login'
          ));
        ?>
        or
        <?php
          echo $html->link(__('register', true), array(
            'controller' => 'users',
            'action' => 'register'
          ));
        ?>
        to comment.
      </p>
    <?php endif; ?>
  </div>
<?php endif; ?>
