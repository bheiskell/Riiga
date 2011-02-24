/* Only JavaScript that should be run on every page! */
$(document).ready(function() {
  jQuery.fx.interval = 100;

  // Always restyle submit buttons
  $('input[type=submit]').button();
  $('textarea').autoGrow();
  $('.chat_box').scrollTop($('.chat_box')[0].scrollHeight);
});
