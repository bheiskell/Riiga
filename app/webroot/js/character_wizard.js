/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */

$(document).ready(function() {

  var rank = $("#CharacterRankId");

  rank.star({
    valueLimit: $("#CharacterUserRank").val(),
    disabledMessage: " exceeds your current rank"
  });

  function limitSelectByRank(selector) {
    var optgroups = $(selector).children().filter("optgroup");
    var lastgroup = optgroups.filter("[label=Rank "+rank.val()+"]");
    optgroups.removeAttr("disabled");
    lastgroup.nextAll().attr("disabled", "disabled");
    if ($(selector).find(':selected').parent().attr('disabled')) {
      $(selector).val($(selector).find('option:first').val());
    }
  }
  function limitSelectByRace(selector) {
    var race = $('#CharacterRaceId');
    var raceName = race.find('option[value='+race.val()+']').text();
    $(selector)
      .children('optgroup')
      .attr('disabled', 'disabled')
      .filter("optgroup[label="+raceName+"]")
      .removeAttr('disabled');
    if ($(selector).find(':selected').parent().attr('disabled')) {
      $(selector).val($(selector).find('option:first').val());
    }
  }

  setupFactionRanks();

  $(".star a").click(function() {
    limitSelectByRank("#CharacterRaceId");
    limitSelectByRank("#CharacterLocationId");

    $("#CharacterRaceId").trigger('change');
  }).trigger('click');

  $("#CharacterRaceId").change(function() {
    limitSelectByRace("#CharacterFactionId");
  });

  document.title = 'Rules Applied';
});

/* Organizational function which sets up the faction ranks widget */
function setupFactionRanks() {

  $("#CharacterFactionId").change(function() {
    /**
     * For some factions, there are multiple entries for the same faction under
     * different optgroups. We need the text from the first.
     */
    var factionName = $(this)
      .find("option[value=" + $(this).val() + "]")
      .first()
      .text();

    /* The table container is prefixed with 'faction_' */
    var factionContainer = $("#faction_" + factionName.replace(' ', '_'));

    var age     = parseInt($("#CharacterAge").val(),    10);
    var rankId  = parseInt($("#CharacterRankId").val(), 10);

    var rows = factionContainer.find('tr').not(':first,:last');

    var ranks = $();
    $(rows.get().reverse()).each(function() {
      if (age >= $(this).data('age') && rankId >= $(this).data('rank_id')) {

        /**
         * Sometimes there will be multiple ranks at the same age/rank_id. If
         * that occurs, be sure to add both to the ranks collection.
         */
        if (0 == ranks.length || (
             ranks.eq(0).data('age')     == $(this).data('age')
          && ranks.eq(0).data('rank_id') == $(this).data('rank_id')
        )) {
          ranks = ranks.add(this);
        }
      }
    });

    if (ranks.length) {
      rows.show().not(ranks).hide();
      factionContainer.siblings().css({ 'position': 'absolute' }).fadeOut();
      factionContainer           .css({ 'position': 'relative' }).fadeIn();
    }
  });

  /**
   * Showing the current rank isn't enough, the user should know all the ranks
   * and ages for their faction. Hovering over the table should display them.
   */
  $("#faction_ranks_tables").hover(function() {
    $(this).find('tr').not(':first,:hidden').addClass('altrow');
    $(this).find('tr').show();
  }, function() {
    $(this).find('tr').removeClass('altrow');
    $("#CharacterFactionId").trigger('change');
  });

  /**
   * To avoid constant dom traversal, set the age and rank_id of each row to the
   * tr element itself.
   */
  $("#faction_ranks_tables").find('td[class=age]').each(function() {
    $(this).parent().data('age', parseInt($(this).text(), 10));
  });
  $("#faction_ranks_tables").find('td[class=rank_id]').each(function() {
    $(this).parent().data('rank_id', parseInt($(this).text(), 10));
  });

  /**
   * Add a visual cue to the table to imply hoving over it will perform some
   * action. In this case, add a footer that appears to be draggable.
   */
  $("#faction_ranks_tables").find('table').append(
    '<tfoot><tr><td colspan="3">| | |</td></tr></tfoot>'
  );

  /* Initialize the divs to hidden and remove the faction header */
  $("#faction_ranks_tables").children().hide().children('h3').hide();
  $("#faction_ranks_tables").find('tr').removeClass('altrow');

  /* Change the CSS - This should be a class... */
  $("#faction_ranks_tables").prev().css({ 'float': 'left' });
  $("#faction_ranks_tables").next().css({ 'clear': 'both' });
  $("#faction_ranks_tables").css({ padding: '0', float: 'right' });
  $("#faction_ranks_tables").children().css({
    'padding': '0',
    'height': 'auto',
    'width': 'auto',
  });
  $("#faction_ranks_tables")
    .find('tfoot td')
    .css({
      'background-color': '#F2F2F2',
      'padding': '1px',
      'text-align': 'center',
      'font-size': '3px',
      'border-top': '1px solid #ccc'
    });
}
