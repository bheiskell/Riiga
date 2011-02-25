<?php
App::import('Helper', 'Markup');
App::import('Helper', 'Html');

class TestMarkup extends MarkupHelper {
}

class MarkupHelperTest extends CakeTestCase {

  var $message = array(
    'base'     => 'Test message',
    'tag'      => 'Test message with user:treijim in it',
    'endTag'   => 'Test message ending with user:treijim',
    'em'       => 'Test message with *em* in it',
    'strong'   => 'Test message with **strong** in it',
    'ooc'      => 'Test message with [an ooc comment] in it',
    'oocSlash' => 'Test message with [an ooc / comment] in it',
  );

  function startTest() {
    $this->Markup       = new TestMarkup();
    $this->Markup->Html = new HtmlHelper();
  }

  function testMarkupInstance() {
    $this->assertTrue(is_a($this->Markup, 'MarkupHelper'));
  }

  function testParse() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['base']),
      $this->message['base']
    ));
    $this->assertEqual(
      $this->message['base'],
      $this->Markup->parse($this->message['base'], 'text')
    );
  }

  function testParseTag() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['tag']),
      '<a href='
    ));
    $this->assertFalse(strpos(
      $this->Markup->parse($this->message['tag'], 'text'),
      '<a href='
    ));
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['tag'], 'text'),
      '/users/view/treijim'
    ));
  }

  function testParseEndTag() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['endTag']),
      '<a href='
    ));
    $this->assertFalse(strpos(
      $this->Markup->parse($this->message['endTag'], 'text'),
      '<a href='
    ));
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['endTag'], 'text'),
      '/users/view/treijim'
    ));
  }

  function testParseEm() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['em']),
      '<em>em</em>'
    ));
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['em'], 'text'),
      '*em*'
    ));
  }

  function testParseStrong() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['strong']),
      '<strong>strong</strong>'
    ));
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['strong'], 'text'),
      '**strong**'
    ));
  }

  function testParseOoc() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['ooc']),
      '<abbr title="an ooc comment">[1]</abbr>'
    ));
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['ooc'], 'text'),
      '[an ooc comment]'
    ));
  }

  function testParseOocSlash() {
    $this->assertTrue(strpos(
      $this->Markup->parse($this->message['oocSlash']),
      '<abbr title="an ooc / comment">[1]</abbr>'
    ));
  }
}
?>
