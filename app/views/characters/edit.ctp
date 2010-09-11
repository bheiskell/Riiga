<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend><?php __('Edit Character');?></legend>
    <?php
      // a (mostly) markup separated rich javascript character creation wizard.
      $html->css(
        'jquery-ui-selectmenu', 'stylesheet', array('media' => 'all'), false
      );
    ?>
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
    <?php
      echo $form->input('name', array(
        'div' => array('id' => 'name')
      ));
      echo $form->input('rank_id', array(
        'label' => 'Level',
        'div' => array('id' => 'rank')
      ));
      echo $form->input('race_id', array(
        'empty' => true,
        'div' => array('id' => 'race')
      ));
      echo $form->input('location_id', array(
        'empty' =>true,
        'div' => array('id' => 'location')
      ));
      echo $form->input('age', array(
        'div' => array('id' => 'age')
      ));
      echo $form->input('faction_id', array(
        'empty' => true,
        'div' => array('id' => 'faction')
      ));
      echo $form->input('profession', array(
        'div' => array('id' => 'profession')
      ));
      echo $form->input('description', array(
        'div' => array('id' => 'description')
      ));
      echo $form->input('history', array(
        'div' => array('id' => 'history')
      ));
      echo $form->input('avatar', array(
        'div' => array('id' => 'avatar')
      ));
      echo $form->input('is_npc', array(
        'div' => array('id' => 'npc')
      ));
    ?>
  </fieldset>
  <?php echo $form->end(__('Submit', true));?>

  <div id="RaceInformation">
    <h3>Race Information</h3>
  </div>
  <div id="LocationInformation">
    <h3>Locations Information</h3>
<?php
  //debug($locationsRaces);
?>
    <?php foreach ($locationsRaces as $raceId => $locationsSubset): ?>
      <div id="LocationId_<?php ?>">
      <?php echo $raceId; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <div id="AgeInformation">
    <h3>Age Information</h3>
    <table>
      <thead>
        <tr>
          <th>Race</th>
          <th>Child</th>
          <th>Teen</th>
          <th>Adult</th>
          <th>Mature</th>
          <th>Elder</th>
          <th>Max</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; ?>
        <?php foreach ($raceAges as $raceAge): ?>
        <?php $class = ($i++ % 2 == 0) ? $class = ' class="altrow"' : null; ?>
        <tr<?php echo $class; ?>
          id="RaceId_<?php echo $raceAge['Race']['id'];?>"
        >
          <th><?php echo $raceAge['Race']['name']; ?></th>
          <td><?php echo $raceAge['RaceAge']['child']; ?></td>
          <td><?php echo $raceAge['RaceAge']['teen']; ?></td>
          <td><?php echo $raceAge['RaceAge']['adult']; ?></td>
          <td><?php echo $raceAge['RaceAge']['mature']; ?></td>
          <td><?php echo $raceAge['RaceAge']['elder']; ?></td>
          <td><?php echo $raceAge['RaceAge']['max']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div id="FactionInformation">
    <h3>Faction ranks by required Level and Age</h3>
    <?php foreach ($factionRanks as $factionId => $factionRanksSubset): ?>
      <div id="FactionId_<?php echo $factionId; ?>">
        <h4><?php echo $factionNames[$factionId]; ?></h4>
        <table>
          <thead>
            <tr>
              <th>Faction Rank</th>
              <th>Rank</th>
              <th>Minimum Age</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; ?>
            <?php foreach ($factionRanksSubset as $factionRank): ?>
              <?php $class = ($i++ % 2 == 0) ? ' class="altrow"' : null; ?>
              <tr<?php echo $class; ?>>
                <td class="name"   ><?php echo $factionRank['name']; ?></td>
                <td class="rank_id"><?php echo $factionRank['rank_id']; ?></td>
                <td class="age"    ><?php echo $factionRank['age']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endforeach; ?>
  </div>
  <div id="ProfessionInformation">
    <h3>Professions by Race and Age</h3>
  </div>
</div>
