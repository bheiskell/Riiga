<?php
App::import('Model', 'User');
App::import('Core', 'Security');

class UserTestCase extends CakeTestCase {
  var $User = null;
  var $fixtures = array(
    'app.character',
    'app.character_location',
    'app.location',
    'app.locations_race',
    'app.location_region',
    'app.location_point',
    'app.location_tag',
    'app.location_tags_location',
    'app.rank',
    'app.race',
    'app.race_age',
    'app.rank',
    'app.faction',
    'app.faction_rank',
    'app.factions_race',
    'app.subrace',
    'app.pending_character',
    'app.profession',
    'app.professions_race',
    'app.profession_category',
    'app.user',
    'app.entry',
    'app.story',
    'app.stories_user',
    'app.characters_story',
    'app.characters_entry',
  );

  function startTest() {
    $this->User  =& ClassRegistry::init('User');
    $this->Entry =& ClassRegistry::init('Entry');

    // Verify fixture assumptions
    $result = $this->User->findById(1);

    $this->assertFalse(empty($result));

    $this->data = $result['User'];

    $this->assertEqual(1, $this->Entry->find('count', array(
      'conditions' => array('user_id' => $this->data['id'])
    )));
  }

  function testUserPassword() {
    $this->data['password_confirm'] =
    $this->data['password']         = '12345';

    $this->assertFalse($this->User->save($this->data));

    $this->data['password_confirm'] =
    $this->data['password']         = '123456';

    $this->assertTrue($this->User->save($this->data));

    $this->assertFalse('123456' === $this->User->field('password')); // hashing
  }

  function testUserPasswordConfirm() {
    $this->assertFalse($this->User->save($this->data));

    $this->data['password_confirm'] = $this->data['password'];

    $this->assertTrue($this->User->save($this->data));

    $this->data['password_confirm'] = $this->data['password'] . 'Mismatch';

    $this->assertFalse($this->User->save($this->data));
  }

  function testUserNoPasswordOnExistingUser() {
    $this->data['password_confirm'] =
    $this->data['password']         = '';

    $this->assertTrue($this->User->save($this->data));
  }

  function testAddHttpToUrl() {
    $this->data['url'] = 'www.google.com';

    $this->assertTrue($this->User->save($this->data));

    $this->assertEqual('http://www.google.com', $this->User->field('url'));
  }

  function testUserInstance() {
    $this->assertTrue(is_a($this->User, 'User'));
  }

  function testUserCaseInsensitivity() {
    $result = $this->User->findByUsername('Lorem Ipsum');

    $this->assertFalse(empty($result));

    $result = $this->User->findByUsername('lorem ipsum');

    $this->assertFalse(empty($result));
  }

  function testUserCheckRank() {
    $this->assertFalse(empty($this->data['rank']));

    $this->User->saveField('is_admin', true);

    // Memory cached value - TODO: Make this not cached - it makes testing hard
    $this->assertEqual(1, $this->User->getRank($this->User->id));
  }

  function testUserIsAdmin() {
    $this->assertEqual(0, $this->data['is_admin']);

    $this->User->saveField('is_admin', true);

    $this->assertEqual(1, $this->User->field('is_admin'));
  }

  function testUserGetEntriesUntilNextRank() {
    $this->assertEqual(19, $this->User->getEntriesUntilNextRank(1));

    // TODO: Add offsets and calculate asserts as well
  }

  function testUserFindAllByStoryId() {
    $this->User->StoriesUser->save(array(
      'story_id' => 1,
      'user_id' => 1,
      'is_moderator' => 1,
      'is_deactivated' => 1,
    ));

    $results = $this->User->find('all_by_story_id', $this->User->id);

    $this->assertFalse(empty($results));
  }
}
?>
