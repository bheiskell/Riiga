/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */

$(document).ready(function() {
  $(":radio:first").parent().star({
    valueLimit: $("#CharacterUserRank").val(),
    disabledMessage: " exceeds your current rank"
  });
});
