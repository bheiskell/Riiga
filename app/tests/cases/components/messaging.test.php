<?php
App::import('Component', 'Messaging');
App::import('Component', 'Auth');
App::import('Component', 'Email');
Mock::generate('AuthComponent');
Mock::generate('EmailComponent');

class TestMessaging  extends MessagingComponent { }
class FakeController extends Controller { }

class MessagingComponentTest extends CakeTestCase {

  var $fixtures = array(
    'app.message',
    'app.user',
    'app.entry',
    'app.story',
    'app.location',
    'app.character_location',
    'app.rank',
    'app.location_region',
    'app.location_point',
    'app.location_tag',
    'app.location_tags_location',
    'app.stories_user',
    'app.characters_story',
    'app.chat',
    'app.character',
    'app.characters_entry',
    'app.faction',
    'app.faction_rank',
    'app.race',
    'app.race_age',
    'app.locations_race',
    'app.professions_race',
    'app.profession',
    'app.profession_category',
    'app.factions_race',
    'app.subrace',
    'app.pending_character',
  );

  public function startTest() {
    $this->Messaging        = new TestMessaging();
    $this->Messaging->Auth  = new MockAuthComponent();
    $this->Messaging->Email = new MockEmailComponent();
    $this->controller       = new FakeController();

    $this->controller->loadModel('User');

    $this->Messaging->startup(&$this->controller);
    $this->recvUser = 2;
  }

  public function testMessagingInstance() {
    $this->assertTrue(is_a($this->Messaging, 'MessagingComponent'));
  }

  public function testUnauthenticatedSend() {
    $this->Messaging->Email->expectNever('send');
    $this->assertFalse($this->Messaging->send($this->recvUser, 'My Message'));
  }

  public function testNoReceiveEmailSend() {

    $this->Messaging->Email->expectNever('send');
    $this->Messaging->Auth->setReturnValue('user',
      $this->controller->User->findById(1)
    );

    $this->assertTrue($this->Messaging->send($this->recvUser, 'My Message'));
    $this->assertFalse($this->Messaging->Email->template);
  }

  public function testReceiveEmailSend() {
    $this->Messaging->Email->expectOnce('send');
    $this->Messaging->Auth->setReturnValue('user',
      $this->controller->User->findById(1)
    );

    $this->controller->User->id = $this->recvUser;
    $this->controller->User->saveField('receive_email', true);

    $this->assertTrue($this->Messaging->send($this->recvUser, 'My Message'));
  }
}
