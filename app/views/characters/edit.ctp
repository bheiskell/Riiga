<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
    // a (mostly) markup separated rich javascript character creation wizard.
    ?>
    <?php $html->css('jquery-ui-selectmenu', 'stylesheet', array('media'=>'all' ), false); ?>
    <?php $javascript->link('jquery-ui-selectmenu.js', false); ?>
    <?php $javascript->link('jquery-ui-star.js',       false); ?>
    <?php $javascript->link('character_wizard.js',     false); ?>

    <?php
    // slightly sloppy inclusion of the user rank into the source for the
    // character creation wizard. if javascript is not enabled this isn't used
    // at all. it should not be treated as authoritative as it's client side.
    ?>
    <?php echo $form->hidden('user_rank', array('value' => $user_rank)); ?>

    <?php echo $form->input('id'); ?>
    <?php echo $form->input('name', array('div' => array('id'=>'name'))); ?>
    <?php echo $form->input('rank_id', array('label'=>'Level','div' => array('id'=>'rank'))); ?>
    <?php echo $form->input('race_id', array('div' => array('id'=>'race'))); ?>
    <?php echo $form->input('location_id', array('div' => array('id'=>'location'))); ?>
    <?php //TODO: Location is soft limited my race ?>
    <?php echo $form->input('age', array('div' => array('id'=>'age'))); ?>
    <!--<div class="help"> </div>-->
    <div id="age_information">
      <table>
        <tr><th>Child</th><th>Teen</th><th>Adult</th><th>Mature</th></tr>
        <tr><td>10</td><td>14</td><td>18</td><td>28</td></tr>
      </table>
    </div>
    <?php //TODO: Age is adjusted by race ?>
    <?php echo $form->input('faction_id', array('empty' => true, 'div' => array('id' =>'faction'))); ?>

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
    <?php echo $form->input('profession', array('div'=>array('id'=>'profession'))); ?>
    <?php //TODO: Display profession data?>


    <?php echo $form->input('description', array('div'=>array('id'=>'description'))); ?>
    <?php echo $form->input('history', array('div'=>array('id'=>'history'))); ?>
    <?php echo $form->input('avatar', array('div'=>array('id'=>'avatar'))); ?>
    <?php echo $form->input('is_npc', array('div'=>array('id'=>'npc'))); ?>
  </fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
