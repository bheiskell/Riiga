<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
    // a (mostly) markup separated rich javascript character creation wizard.
    ?>
    <?php $javascript->link('jquery-star.js',      false); ?>
    <?php $javascript->link('character_wizard.js', false); ?>

    <?php
    // slightly sloppy inclusion of the user rank into the source for the
    // character creation wizard. if javascript is not enabled this isn't used
    // at all. it should not be treated as authoritative as it's client side.
    ?>
    <?php echo $form->hidden('user_rank', array('value' => $user_rank)); ?>

    <?php echo $form->input('id'); ?>
    <?php echo $form->input('name'); ?>
    <?php echo $form->input('rank_id'); ?>
    <?php echo $form->input('race_id'); ?>
    <?php echo $form->input('location_id'); ?>
    TODO: Location is soft limited my race
    <?php echo $form->input('age'); ?>
    TODO: Age is adjusted by race
    <?php echo $form->input('faction_id', array('empty' => true)); ?>

    <div id="faction_ranks_tables">
      <?php foreach ($factionRanks as $factionName => $faction): ?>
        <div id="faction_<?php echo str_replace(' ', '_', $factionName); ?>">
          <h3><?php echo $factionName; ?></h3>
          <table>
            <tr>
              <th>Faction Rank</th>
              <th>Rank</th>
              <th>Min. Age</th>
            </tr>
            <?php $i = 0; ?>
            <?php foreach ($faction as $factionRank): ?>
              <?php $class = ($i++ % 2 == 0) ? ' class="altrow"' : null; ?>
              <tr<?php echo $class; ?>>
                <td class="name"   ><?php echo $factionRank['name']; ?></td>
                <td class="rank_id"><?php echo $factionRank['rank_id']; ?></td>
                <td class="age"    ><?php echo $factionRank['age']; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      <?php endforeach; ?>
    </div>
    <?php echo $form->input('profession'); ?>
    TODO: Display profession data


    <?php echo $form->input('description'); ?>
    <?php echo $form->input('history'); ?>
    <?php echo $form->input('avatar'); ?>
    <?php echo $form->input('is_npc'); ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
