<div class="characters form">
<?php echo $form->create('Character');?>
  <fieldset>
    <legend>
      <?php
        (isset($this->data)) ? __('Edit Character') : __('Create Character');
      ?>
    </legend>
    <?php
      // a (mostly) markup separated rich javascript character creation wizard.
      $html->css(
        'jquery-ui-selectmenu', 'stylesheet', array('media' => 'all'), false
      );
    ?>
    <?php $javascript->link('jquery-autoresize.min.js', false); ?>
    <?php $javascript->link('jquery-ui-selectmenu.js',  false); ?>
    <?php $javascript->link('jquery-ui-star.js',        false); ?>
    <?php $javascript->link('character_wizard.js',      false); ?>

    <?php
    // slightly sloppy inclusion of the user rank into the source for the
    // character creation wizard. if javascript is not enabled this isn't used
    // at all. it should not be treated as authoritative as it's client side.
    ?>
    <?php echo $form->hidden('user_rank', array('value' => $user_rank)); ?>

    <?php if(isset($this->data)) echo $form->input('id'); ?>
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
    <?php foreach ($raceInfo as $race): ?>
      <div class="RaceId_<?php echo $race['Race']['id']; ?>">
        <h4><?php echo $race['Race']['name']; ?></h4>
        <p><?php echo $race['Race']['description']; ?></p>
        Requires Level <?php echo $race['Rank']['id']; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <div id="LocationInformation">
    <h3>Locations Information</h3>
    <?php foreach ($locationInfo as $location): ?>
      <div class="LocationId_<?php echo $location['Location']['id']; ?>">
        <h4><?php echo $location['Location']['name']; ?></h4>
        <p><?php echo $location['Location']['description']; ?></p>
        <table>
          <thead>
            <tr><th>Race</th><th>Likelihood</th></tr>
          </thead>
          <tbody>
            <?php if (isset($locationsRaces[$location['Location']['id']])): ?>
              <?php $i = 0; ?>
              <?php
                foreach ($locationsRaces[$location['Location']['id']] as $race):
              ?>
                <tr class="RaceId_<?php
                  echo $race['Race']['id'];
                  if (0 == $i++ % 2) echo ' altrow';
                ?>">
                  <td><?php echo $race['Race']['name']; ?></td>
                  <td><?php echo $race['LocationsRace']['likelihood']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        Requires Level <?php echo $location['Rank']['id']; ?>
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
        <?php foreach ($ageInfo as $race): ?>
        <tr class="RaceId_<?php
            echo $race['Race']['id'];
            if (0 == $i++ % 2) echo ' altrow';
        ?>">
          <th><?php echo $race['Race']['name']; ?></th>
          <td><?php echo $race['RaceAge']['child']; ?></td>
          <td><?php echo $race['RaceAge']['teen']; ?></td>
          <td><?php echo $race['RaceAge']['adult']; ?></td>
          <td><?php echo $race['RaceAge']['mature']; ?></td>
          <td><?php echo $race['RaceAge']['elder']; ?></td>
          <td><?php echo $race['RaceAge']['max']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div id="FactionInformation">
    <h3>Faction ranks by required Level and Age</h3>
    <?php foreach ($factionInfo as $faction): ?>
      <?php $factionId = $faction['Faction']['id']; ?>
      <div class="FactionId_<?php echo $factionId; ?>">
        <h4><?php echo $faction['Faction']['name']; ?></h4>
        <p><?php echo $faction['Faction']['description']; ?></p>
        <table>
          <thead>
            <tr>
              <th>Faction Rank</th>
              <th>Minimum Level</th>
              <th>Minimum Age</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; ?>
            <?php foreach ($factionRanks[$factionId] as $factionRank): ?>
                <tr <?php if (0 == $i++ % 2) echo 'class="altrow"';?>>
                <td><?php echo $factionRank['name']; ?></td>
                <td><?php echo $factionRank['rank_id']; ?></td>
                <td><?php echo $factionRank['age']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endforeach; ?>
  </div>
  <div id="ProfessionInformation">
    <h3>Professions by Race and Age</h3>
    <?php foreach ($professionInfo as $categoryName => $professions): ?>
      <div>
        <h4><?php echo $categoryName; ?></h4>
        <?php foreach ($professions as $profession): ?>
          <div>
            <h5><?php echo $profession['Profession']['name']; ?></h5>
            <table>
              <thead><tr><th>Race</th><th>Minimum Age</th></tr></thead>
              <tbody>
                <?php $i = 0; ?>
                <?php foreach ($profession['ProfessionsRace'] as $race):?>
                  <tr <?php if (0 == $i++ % 2) echo 'class="altrow"';?>>
                    <td class="RaceId_<?php echo $race['race_id']; ?>">
                      <?php echo $raceNames[$race['race_id']]; ?>
                    </td>
                    <td><?php echo $race['age']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
