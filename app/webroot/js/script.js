/* Only JavaScript that should be run on every page! */
$(document).ready(function() {
  // Always restyle submit buttons
  $('input[type=submit]').button();
  $('textarea').autoResize().trigger('change.dynSiz');
});
