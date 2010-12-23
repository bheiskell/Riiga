<? if (isset($chats)): ?>
  <div class="chat_box">
    <?php if (!empty($chats)): ?>
    <table>
      <tbody>
        <?php $altrow->reset(); ?>
        <?php foreach ($chats as $chat): ?>
          <tr<?php echo $altrow; ?>>
            <td>
              <?php
                echo $html->link($chat['User']['username'], array(
                  'controller' => 'users',
                  'action' => 'view',
                  'id' => $chat['User']['id']
                ));
              ?>
            </td>
            <td><?php echo h($chat['Chat']['message']); ?></td>
            <td>
              <?php echo date('Y-m-d', strtotime($chat['Chat']['created'])); ?>
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
