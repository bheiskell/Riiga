<?php if (isset($locationInfo)): ?>
  <div id="LocationInformation">
    <h3>Locations Information</h3>
    <?php echo $html->image('map/riiga.jpg'); ?>
    <?php foreach ($locationInfo as $location): ?>
      <?php $locationId = $location['Location']['id']; ?>

      <div class="LocationId_<?php echo h($locationId); ?>">
        <h4><?php echo h($location['Location']['name']); ?></h4>

        <?php if (!empty($location['LocationTag'])): ?>
          <ul>
            <?php foreach ($location['LocationTag'] as $tag): ?>
              <li>
                <?php
                  echo $html->image($tag['url'], array(
                    'alt' => $tag['name'],
                    'title' => $tag['name'] . ' - ' . $tag['description'],
                  ));
                ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <p><?php  echo h($location['Location']['description']); ?></p>

        <?php if (isset($location['Race'])): ?>
          <table>
            <thead><tr><th>Race</th><th>Likelihood</th></tr></thead>
            <tbody>
              <?php $altrow->reset(); ?>
              <?php foreach ($location['Race'] as $race): ?>
                <tr<?php echo $altrow->get('RaceId_'.h($race['Race']['id']));?>>
                  <td><?php echo h($race['Race']['name']); ?></td>
                  <td><?php echo h($race['LocationsRace']['likelihood']);?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>

        <?php if (isset($location['LocationRegion'])): ?>
          <dl>
            <dt>Left</dt>
            <dd><?php echo h($location['LocationRegion']['left']); ?></dd>
            <dt>Top</dt>
            <dd><?php echo h($location['LocationRegion']['top']); ?></dd>
            <dt>Width</dt>
            <dd><?php echo h($location['LocationRegion']['width']); ?></dd>
            <dt>Height</dt>
            <dd><?php echo h($location['LocationRegion']['height']); ?></dd>
          </dl>
        <?php endif; ?>

        <?php if (isset($location['LocationPoint'])): ?>
          <dl>
            <dt>X</dt>
            <dd><?php echo h($location['LocationPoint']['x']); ?></dd>
            <dt>Y</dt>
            <dd><?php echo h($location['LocationPoint']['y']); ?></dd>
          </dl>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
