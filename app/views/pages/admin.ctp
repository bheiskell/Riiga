<?php if (isset($isAdmin) && $isAdmin): ?>
  <div class="pages admin">
    <h2>Admin URLs</h2>
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
        'Subraces'              => 'subraces',
      );
    ?>
    <ul>
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
  </div>
<?php endif; ?>
