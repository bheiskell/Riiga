<?php
  $this->set('dData', array(
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
  ));

  $this->set('cData', array(
    'language'    => 'en-us',
    'title'       => __('Riiga.net Latest Entries', true),
    'description' => __('Latest for stories tied to a user on Riiga.net', true),
    'link'        => '/',
  ));

  foreach ($entries as $entry) {
    echo $rss->item(array(), array(
      'title'       => h($entry['Story']['name']),
      'description' => h($entry['Entry']['content']),
      'dc:creator'  => h($entry['User']['username']),
      'pubDate'     => $entry['Entry']['created'],
      'link'        => array(
        'controller' => 'stories',
        'action'     => 'view',
        'id'         => $entry['Story']['slug'],
        'page'       => 'last',
        '#'          => $entry['Entry']['id'],
      ),
    ));
  }
