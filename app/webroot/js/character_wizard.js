/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */

$(document).ready(function() {

  var rank = $("select[name=data\\[Character\\]\\[rank_id\\]]");

  rank.star({
    valueLimit: $("#CharacterUserRank").val(),
    disabledMessage: " exceeds your current rank"
  });

  var applyRules = function() {
    function limitSelectByRank(selector, rank) {
      var optgroups = $(selector).children().filter("optgroup");
      var lastgroup = optgroups.filter("[label=Rank "+rank+"]");
      optgroups.removeAttr("disabled");
      lastgroup.nextAll().attr("disabled", "disabled");
    }
    limitSelectByRank("#CharacterRaceId", rank.val());
    limitSelectByRank("#CharacterLocationId", rank.val());
  }

  applyRules();
  $(".star a").click(applyRules);

  document.title = 'Rules Applied';
});
