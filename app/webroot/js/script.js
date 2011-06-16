/* Only JavaScript that should be run on every page! */
$(document).ready(function() {
  jQuery.fx.interval = 100;

  // Always restyle submit buttons
  $('input[type=submit]').button();
  $('textarea').TextAreaExpander(100);
  $('.chat_box').scrollTop($('.chat_box')[0].scrollHeight);
  $('abbr').qtip();
});
