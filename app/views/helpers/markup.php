<?php
/**
 * MarkupHelper
 *
 * Riiga custom markup parser
 *
 * @uses AppHelper
 * @author Ben Heiskell <ben.heiskell@gmail.com>
 */
class MarkupHelper extends AppHelper {

  var $helpers = array('Html');

  /**
   * parse
   *
   * Parse the raw text and return HTML.
   *
   * @param mixed $raw Raw text to be parsed
   * @param string $format Format of 'text' or 'html'
   * @access public
   * @return void
   */
  public function parse($raw, $format = 'html') {
    $wrapped      = $this->wrapper($raw, $format);
    $replacements = array();

    $this->parseTags    ($wrapped, $replacements, $format);
    $this->parseOoc     ($wrapped, $replacements, $format);
    $this->parseMarkdown($wrapped, $replacements, $format);

    return preg_replace(array_keys($replacements), $replacements, $wrapped);
  }

  /**
   * wrapper
   *
   * Wrap the marked up text however is needed for the format
   *
   * @param mixed $raw 
   * @param mixed $format 
   * @access private
   * @return string Wrapped text
   */
  private function wrapper($raw, $format) {
    return ('html' == $format)
      ? $this->Html->tag('pre', h($raw), array('class' => 'markup'))
      : $raw;
  }

  /**
   * parseTags
   *
   * Parse custom Riiga tags and return by reference preg_replace rules based
   * on the format
   *
   * @param mixed $raw 
   * @param mixed $replacements 
   * @param mixed $format 
   * @access private
   * @return void
   */
  private function parseTags($raw, &$replacements, $format) {
    $tagex = '/(user|character|story|entry|riiga):([a-z0-9_]+)([^a-z0-9_]|$)/';
    if (preg_match_all($tagex, $raw, $matches)) {
      foreach ($matches[0] as $key => $match) {
        list($tag, $value) = array($matches[1][$key], $matches[2][$key]);

        $url = array(
          'controller' => Inflector::pluralize($tag),
          'action'     => 'view',
          $value,
        );

        if ('html' === $format) {
          $replacements["/$tag:$value/"] = $this->Html->link("$tag:$value",
            $this->Html->url($url, true)
          );

        } else if ('text' === $format) {
          $replacements["/$tag:$value/"] = $this->Html->url($url, true);
        }
      }
    }
  }

  /**
   * parseOoc
   *
   * Parse the out of character comments and return by reference the preg
   * replace rules based on the format
   *
   * @param mixed $raw 
   * @param mixed $replacements 
   * @param mixed $format 
   * @access private
   * @return void
   */
  private function parseOoc($raw, &$replacements, $format) {
    $oocex = '/\[([^\[\]]+)\]/';

    if ('html' === $format) {
      if (preg_match_all($oocex, $raw, $matches)) {
        foreach ($matches[0] as $key => $match) {

          $regex     = '/' . preg_quote($match) . '/';
          $reference = $key + 1;
          $comment   = $matches[1][$key];

          $replacements[$regex] = $this->Html->tag(
            'abbr',
            '[' . $reference . ']',
            array('title' => $comment)
          );
        }
      }
    }
  }

  /**
   * parseMarkdown
   *
   * Parse the limitted set of markdown supported according to the format and
   * return the preg_replace rules by reference.
   *
   * @param mixed $raw 
   * @param mixed $replacements 
   * @param mixed $format 
   * @access private
   * @return void
   */
  private function parseMarkdown($raw, &$replacements, $format) {
    if ('html' === $format) {
      $replacements['/\*\*([^\*]*)\*\*/'] = '<strong>\1</strong>';
      $replacements['/\*([^\*]*)\*/']     = '<em>\1</em>';
    }
  }
}
