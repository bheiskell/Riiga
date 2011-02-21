<div class="users view">
  <h2><?php echo h($user['User']['username']); ?></h2>
  <div class="avatar">
    <?php echo $avatar->user($user['User']); ?>
    <?php echo $stars->render($user['User']['rank']); ?>
    <?php if ($user['User']['is_admin']): ?>
      <span>administrator</span>
    <?php endif; ?>
  </div>
  <ul>
    <?php if ($userId == $user['User']['id']): ?>
      <li>
        <?php
          echo $html->link(__('Edit profile', true), array('action' => 'edit'));
        ?>
      </li>
    <?php else: ?>
      <li>
        <?php
          echo $html->link(
            __('Send private message', true),
            array('action' => 'message', $user['User']['id'])
          );
        ?>
      </li>
    <?php endif; ?>
    <!-- Incomplete
    <li>
      <?php
        echo $html->link(
          __('Invite to a story', true),
          array(
            'controller' => 'invites',
            'action' => 'user',
            'id' => $user['User']['id'],
          )
        );
      ?>
    </li>
    -->
    <?php if ($user['User']['url']): ?>
      <li>
        <?php echo $html->link( __("Website", true), $user['User']['url']); ?>
      </li>
    <?php endif; ?>
    <?php if ($nextRank): ?>
      <li>Next rank in <?php echo h($nextRank); ?> entries</li>
    <?php endif; ?>
  </ul>
  <?php if (!empty($user['Character'])):?>
    <div class="related">
      <h3><?php __('Characters');?></h3>
      <?php echo $this->element('characters', array('options' => 'current_story')); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($stories)):?>
    <div class="related">
      <h3><?php __('Stories');?></h3>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Turn</th>
            <th>Latest Post Author</th>
            <th>Latest Post Date</th>
          </tr>
        </thead>
        <tbody>
          <?php $altrow->reset(); ?>
          <?php foreach($stories as $story): ?>
            <tr<?php echo $altrow; ?>>
              <td>
                <?php
                  echo $html->link(
                    $story['Story']['name'],
                    array(
                      'controller' => 'stories',
                      'action'     => 'view',
                      'id'         => $story['Story']['slug']
                    )
                  );
                ?>
              </td>
              <td>
                <?php
                  echo $html->link(
                    $story['Turn']['username'],
                    array(
                      'action'     => 'view',
                      'id'         => $story['Turn']['slug']
                    )
                  );
                ?>
              </td>
              <td>
                <?php
                  echo $html->link(
                    $story['LatestEntryUser']['username'],
                    array(
                      'action'     => 'view',
                      'id'         => $story['LatestEntryUser']['slug']
                    )
                  );
                ?>
              </td>
              <td>
                <?php echo $date->date($story['LatestEntry']['created']); ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
