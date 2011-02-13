<div class="ranks index">
  <h2>User Ranks</h2>
  <p>
    User ranks are gained by adding entries to stories. At each rank milestone,
    you are able to create an additional character. As your characters gain
    levels, they become stronger and are acquire access to higher faction
    ranks.
  </p>

  <p>
    Your current rank is
    <?php echo h($ranks[$rankId]['Rank']['name']); ?> at
    <?php echo h($entriesCount); ?> posts.
  </p>
  <?php if ($nextRankId): ?>
    <p>
      You need
      <?php echo $ranks[$nextRankId]['Rank']['entry_count'] - $entriesCount; ?>
      post to reach the next rank of
      <?php echo h($ranks[$nextRankId]['Rank']['name']); ?>.
    </p>
  <?php else: ?>
    <p>This is the max rank available.</p>
  <?php endif; ?>

  <?php foreach ($ranks as $rank): ?>
    <h3><?php echo h($rank['Rank']['name']); ?></h3>
    <?php echo $stars->render($rank['Rank']['id']); ?>
    <p>Unlocked at <?php echo h($rank['Rank']['entry_count']); ?> posts</p>
  <?php endforeach; ?>
</div>
