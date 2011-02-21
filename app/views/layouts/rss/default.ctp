<?php echo $rss->header(); ?>
<?php $dData          = (isset($dData))          ? $dData : array(); ?>
<?php $cData          = (isset($cData))          ? $cData : array(); ?>
<?php $cData['title'] = (isset($cData['title'])) ? $cData['title']
                                                 : $title_for_layout; ?>

<?php $channel = $rss->channel(array(), $cData, $content_for_layout); ?>
<?php echo $rss->document($dData, $channel); ?>
