<?php
  $this->set('dData', array(
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
  ));

  $this->set('cData', array(
    'language'    => 'en-us',
    'title'       => __('Riiga.net Chat', true),
    'description' => __('Latest chat messages on Riiga.net', true),
    'link'        => '/',
  ));

  foreach ($chats as $chat) {
    echo $rss->item(array(), array(
      'title'       => h($chat['User']['username']),
      'description' => h($chat['Chat']['message']),
      'dc:creator'  => h($chat['User']['username']),
      'pubDate'     => $chat['Chat']['created'],
    ));
  }
