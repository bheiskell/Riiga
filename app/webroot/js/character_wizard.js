/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */

$(document).ready(function() {

  var ranks = $("input[name=data\\[Character\\]\\[rank\\]]");

  ranks.filter(":first").parent().star({
    valueLimit: $("#CharacterUserRank").val(),
    disabledMessage: " exceeds your current rank"
  });

  $("#CharacterWallet").before(
    $('<div id="CharacterWalletSlider"></div>').slider({
      change: function() {
        $("#CharacterWallet").val($(this).slider("option", "value"));
      }
    })
  );

  var applyRules = function() {
    var rank = ranks.filter(":checked").val();
    function limitResidencyByRank(rank) {
      var lastEnabled = $("#CharacterResidency optgroup[label=Rank "+rank+"]");
      lastEnabled.prevAll().andSelf().removeAttr("disabled");
      lastEnabled.nextAll()                .attr("disabled", "disabled");
    }
    limitResidencyByRank(rank);

    $("#CharacterWalletSlider").slider({max: 100});

  }

  applyRules();
  $(".star a").click(applyRules);

  document.title = 'Rules Applied';
});
