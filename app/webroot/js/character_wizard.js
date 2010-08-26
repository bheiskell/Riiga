/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */
$(document).ready(function() {
  var userRank  = $('#CharacterUserRank'),
      rank      = $('#CharacterRankId'),
      race      = $('#CharacterRaceId'),
      location  = $('#CharacterLocationId'),
      age       = $('#CharacterAge'),
      faction   = $('#CharacterFactionId');

  // TODO: Cake should set these to disabled.
  $('option[value='+userRank.val()+']', rank)
    .nextAll()
    .attr('disabled', 'disabled');

  rank.star();

  // Reapply rules when a parent field changes
  race    .bind('limit', limitByRank);
  location.bind('limit', limitByRank);
  faction .bind('limit', limitByRace);

  rank.bind('starselect', function() {
    race    .trigger('limit', [rank]).trigger('change');
    location.trigger('limit', [rank]).trigger('change');
  })
  race.change(function() {
    faction.trigger('limit', [race]).trigger('change');
  });
  age.change(function() {
    faction.trigger('change');
  });

  // Activate rules
  rank.trigger('starselect');

  // TODO: Move this elsewhere
  /**
   * Use selectmenu as a base and extend required functionality to support a
   * hover div off to the side. This requires a few new triggers.
   */
  $.widget('ui.select', $.ui.selectmenu, {
    _init: function() {
      $.ui.selectmenu.prototype._init.call(this);
      var self = this;
      $('li', this.list).mouseover(function() {
        self._trigger('menuHover', 0, this);
      });
    },
    open: function(event) {
      $.ui.selectmenu.prototype.open.call(this);
      this._trigger('menuOpen', event, this.list);
    },
    close: function(event) {
      $.ui.selectmenu.prototype.close.call(this);
      this._trigger('menuClose', event, this.list);
    },
  });

  // Remove the optgroups and postfix each option with its optgroups label. The
  // optgroup label will be converted to some number of stars. I.e.:
  //   <optgroup label="Rank 5"><option ...>Label</option></optgroup> becomes
  //   <option ...>Label *****</option>
  $().add(race).add(location).each(function() {
    $(this).find('option').each(function() {
      var optgroupLabel = $(this).parent().attr('label');

      var rank = parseInt(optgroupLabel.replace('Level ', ''), 10);

      // Create empty array of rank+1 and join with '*' to get a string of rank
      // stars. Hack, but simple once you get what's going on.
      var rankStars = new Array(rank+1).join('*');

      $(this).text($(this).text() + ' ' + rankStars);

    }).clone().appendTo(this);
    $(this).find('optgroup').remove();
  });

  $().add(race).add(location).add(faction).each(function() {
    $(this).select({
      style: 'dropdown',
      // TODO: Don't use constants
      menuWidth: $(this).outerWidth(),
      menuHover: function(event, option) {
        $('#selectHoverBox').text($(option).data('index'));
      },
      menuOpen: function(event, menu) {
        $('#selectHoverBox').remove();
        var element = $('<div id="selectHoverBox"></div>')
          .css({
            'height': menu.height()+'px',
            'width':  menu.width() +'px',
            'background': '#fff',
            'z-index': 1,
            'border': '1px solid #B6A792',
            '-moz-border-radius': '4px',
            'border-radius': '4px',
          })
          .appendTo('body')
          .position({ my: "left top", at: "right top", of: menu })
          .hide()
          .effect('slide');
      },
      menuClose: function(event, menu) { $('#selectHoverBox').remove(); },
      format: function(text) {
        return text
          .replace(/(\*+)/,'<span class="stars">$1</span>')
          .replace(/\*/g, '<span class="star">&nbsp;</span>');
      },
    });
  });

  $('#CharacterIsNpc').button();

  // TODO: Clean up
  $("#age input").focus(function () {
    $("#age_information").slideDown();
    $(this).parent().css({'border-bottom': '0 solid #000'});
  });
  $("#age input").blur(function () {
    $("#age_information").slideUp();
    $(this).parent().css({'border-bottom': '1px solid #ccc'});
  });
  $("#age").css({'border-bottom':'1px solid #ccc'});
  $("#age_information").css({'margin-bottom':0}).hide();
  $("#faction").css({'margin-top':'12px'});
  $("#profession").css({'margin-top':'12px'});

  /* Get rid of this freaking thing */
  //setupFactionRanks(faction);
  $("#faction_ranks_tables").hide();

  /* TODO: remove title totem */
  document.title = 'Rules Applied';
});

/**
 * Optgroups are disabled, but their children are not. Ensure that if a child
 * is a member of a disabled optgroup, the select resets to the default value.
 */
var resetIfDisabled = function(select) {
  if ($(select).find('option:selected').attr('disabled')) {
    $(select).val($('option:first', $(select)).val());
  }
}

var limitByRank = function(event, rank) {
  $('option', this).removeAttr('disabled');
  $('optgroup[label=Level '+rank.val()+']', this)
    .nextAll()
    .children('option')
    .attr('disabled', 'disabled');
  resetIfDisabled(this);
};

var limitByRace = function(event, race) {
  $('option:not(:first)', this).attr('disabled', 'disabled')
  $('optgroup[label=' + race.find('option:selected').text() + '] option', this)
    .removeAttr('disabled');
  resetIfDisabled(this);
};

/* Organizational function which sets up the faction ranks widget */
function setupFactionRanks(faction) {

  faction.change(function() {
    /**
     * For some factions, there are multiple entries for the same faction under
     * different optgroups. We need the text from the first.
     */
    var factionName = $(this).find("option:selected").text();

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


    rows.show().not(ranks).hide();
    factionContainer.siblings().css({ 'position': 'absolute' }).fadeOut();
    factionContainer           .css({ 'position': 'relative' }).fadeIn();
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
    faction.trigger('change');
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
  $("#faction_ranks_tables").children().hide().children('h3').text(
    'Faction Rank Requirements'
  );
  $("#faction_ranks_tables").find('tr').removeClass('altrow');

  /* Change the CSS - This should be a class... */
  $("#faction_ranks_tables").prev().css({ 'float': 'left' });
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
