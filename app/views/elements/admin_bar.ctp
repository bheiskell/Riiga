<?php if (isset($isAdmin) && $isAdmin): ?>
  <?php
    // TODO: Inflect
    $links = array(
      'Characters'            => 'characters',
      'Ranks'                 => 'ranks',
      'Races'                 => 'races',
      'Race Ages'             => 'race_ages',
      'Character Locations'   => 'character_locations',
      'Locations'             => 'locations',
      'Locations Races'       => 'locations_races',
      'Location Tags'         => 'location_tags',
      'Factions'              => 'factions',
      'Faction Ranks'         => 'faction_ranks',
      'Profession Categories' => 'profession_categories',
      'Professions'           => 'professions',
      'Professions Races'     => 'professions_races',
    );
  ?>
  <ul id="admin">
    <?php foreach ($links as $text => $controller): ?>
      <li>
        <?php
          echo $html->link(__($text, true), array(
            'controller' => $controller,
            'action' => 'index',
            'admin' => true,
          ));
        ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
