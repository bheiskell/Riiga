<?php
  $html->css(
    'jquery-ui-selectmenu', 'stylesheet', array('media' => 'all'), false
  );
?>
<?php $javascript->link('jquery-autoresize.min.js', false); ?>
<?php $javascript->link('jquery-ui-selectmenu.js',  false); ?>
<?php $javascript->link('jquery-ui-star.js',        false); ?>
<?php $javascript->link('jquery-ui-location.js',    false); ?>
<?php $javascript->link('character_wizard.js',      false); ?>
<div class="characters form">
  <?php echo $form->create('Character');?>
    <fieldset>
      <legend>
        <?php
          (isset($this->data)) ? __('Edit Character') : __('Create Character');
        ?>
      </legend>

      <?php echo $form->hidden('user_rank', array('value' => $user_rank)); ?>
      <?php echo $form->input('id'); ?>
      <?php echo $form->hidden('pending_id'); ?>
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
      <div class="RaceId_<?php echo h($race['Race']['id']); ?>">
        <div>
          <?php
            echo $html->image(
              'race/' . h(strtolower($race['Race']['name'])) . '.png'
            );
          ?>
        </div>
        <h4><?php echo h($race['Race']['name']); ?></h4>
        <p><?php echo h($race['Race']['description']); ?></p>
        Requires Level <?php echo h($race['Race']['rank_id']); ?>
      </div>
    <?php endforeach; ?>
  </div>
  <div id="LocationInformation">
    <h3>Locations Information</h3>
    <?php echo $html->image('map/riiga.png'); ?>
    <?php foreach ($locationInfo as $location): ?>
      <?php $locationId = $location['Location']['id']; ?>
      <div class="LocationId_<?php echo h($locationId); ?>">
        <h4><?php echo h($location['Location']['name']); ?></h4>
        <p><?php echo h($location['Location']['description']); ?></p>
        <table>
          <thead>
            <tr><th>Race</th><th>Likelihood</th></tr>
          </thead>
          <tbody>
            <?php if (isset($locationsRaces[$locationId])): ?>
              <?php $altrow->reset(); ?>
              <?php
                foreach ($locationsRaces[$locationId] as $race):
              ?>
                <tr<?php echo $altrow->get('RaceId_'.h($race['Race']['id']));?>>
                  <td><?php echo h($race['Race']['name']); ?></td>
                  <td><?php echo h($race['LocationsRace']['likelihood']);?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        <p>
          Requires Level
          <?php echo h($locationRanks[$locationId]); ?>
        </p>
        <dl>
          <dt>Left</dt>
          <dd>
            <?php echo h($locationRegions[$locationId]['left']); ?>
          </dd>
          <dt>Top</dt>
          <dd>
            <?php echo h($locationRegions[$locationId]['top']); ?>
          </dd>
          <dt>Width</dt>
          <dd>
            <?php echo h($locationRegions[$locationId]['width']); ?>
          </dd>
          <dt>Height</dt>
          <dd>
            <?php echo h($locationRegions[$locationId]['height']); ?>
          </dd>
        </dl>
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
        <?php $altrow->reset(); ?>
        <?php foreach ($ageInfo as $race): ?>
        <tr <?php echo $altrow->get('RaceId_'.h($race['Race']['id'])); ?>>
          <th><?php echo h($raceNames[$race['Race']['id']]); ?></th>
          <td><?php echo h($race['RaceAge']['child']); ?></td>
          <td><?php echo h($race['RaceAge']['teen']); ?></td>
          <td><?php echo h($race['RaceAge']['adult']); ?></td>
          <td><?php echo h($race['RaceAge']['mature']); ?></td>
          <td><?php echo h($race['RaceAge']['elder']); ?></td>
          <td><?php echo h($race['RaceAge']['max']); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div id="FactionInformation">
    <h3>Faction ranks by required Level and Age</h3>
    <?php foreach ($factionInfo as $faction): ?>
      <?php $factionId = $faction['Faction']['id']; ?>
      <div class="FactionId_<?php echo h($factionId); ?>">
        <h4><?php echo h($faction['Faction']['name']); ?></h4>
        <p><?php echo h($faction['Faction']['description']); ?></p>
        <table>
          <thead>
            <tr>
              <th>Faction Rank</th>
              <th>Minimum Level</th>
              <th>Minimum Age</th>
            </tr>
          </thead>
          <tbody>
            <?php $altrow->reset(); ?>
            <?php foreach ($factionRanks[$factionId] as $factionRank): ?>
                <tr<?php echo $altrow;?>>
                <td><?php echo h($factionRank['name']); ?></td>
                <td><?php echo h($factionRank['rank_id']); ?></td>
                <td><?php echo h($factionRank['age']); ?></td>
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
        <h4><?php echo h($categoryName); ?></h4>
        <?php foreach ($professions as $profession): ?>
          <div>
            <h5><?php echo h($profession['Profession']['name']); ?></h5>
            <table>
              <thead><tr><th>Race</th><th>Minimum Age</th></tr></thead>
              <tbody>
                <?php $altrow->reset(); ?>
                <?php foreach ($profession['ProfessionsRace'] as $race):?>
                  <tr<?php echo $altrow;?>>
                    <td class="RaceId_<?php echo h($race['race_id']); ?>">
                      <?php echo h($raceNames[$race['race_id']]); ?>
                    </td>
                    <td><?php echo h($race['age']); ?></td>
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
