Dear <?php echo $recv['User']['username']; ?>:

You have received a new message from <?php echo $send['User']['username']; ?>:
------------------------------------------------------------------------
<?php echo $brief; ?>:

<?php echo $message; ?> 
------------------------------------------------------------------------

Reply       - http://riiga.net/users/view_message/<?php echo $messageId; ?> 
Unsubscribe - http://riiga.net/users/unsubscribe/<?php echo $recv['User']['slug']; ?>/verification:<?php echo $verification; ?>
