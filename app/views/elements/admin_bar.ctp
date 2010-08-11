<?php if (1 || $is_admin): //TODO ?>
  <?php
    $links = array(
      'Ranks'                 => 'ranks',
      'Races'                 => 'races',
      'Race Ages'             => 'race_ages',
      'Character Locations'   => 'character_locations',
      'Locations Races'       => 'locations_races',
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
            'admin' => true,
          ));
        ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
