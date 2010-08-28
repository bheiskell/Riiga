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
        return self._trigger('menuHover', 0, this);
      });
    },
    value: function(newValue) {
      $(this).data('clickDisabled', // TODO: HACK THIS SUCKS FIX IT
        this.element
          .find('option')
          .eq(newValue)
          .attr('disabled')
      );
      return (arguments.length && !$(this).data('clickDisabled'))
        ? $.ui.selectmenu.prototype.value.call(this, newValue)
        : $.ui.selectmenu.prototype.value.call(this);

    },
    open: function(event) {
      var ret = $.ui.selectmenu.prototype.open.call(this);
      this.setDisabled();
      this._trigger('menuOpen', event, this.list);
      return ret;
    },

    close: function(event, retainFocus) {
      if (retainFocus && $(this).data('clickDisabled')) return;
      var ret = $.ui.selectmenu.prototype.close.call(this, event, retainFocus);
      this._trigger('menuClose', event, this.list);
      return ret;
    },
    setDisabled: function() {
      var options = this.element.find('option');
      $('li', this.list).each(function() {
        var disabled = options.eq($(this).data('index')).attr('disabled');
        if (disabled) {
          $(this).addClass('ui-state-disabled');
        } else {
          $(this).removeClass('ui-state-disabled');
        }
      });
    }
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
/*
Hover method should take some sort of group of elements indexed by the same
index as the select menu.

Anonymous functions that map an option tag to a jquery container that will be cloned

*/
  $().add(race).add(location).add(faction).each(function() {
    var isLocation = location[0] == this;
    var isFaction = faction[0] == this;
    $(this).select({
      style: 'dropdown',
      menuWidth: $(this).outerWidth(),
      menuHover: function(event, option) {
        $('.ui-selectbox').children().remove();
        var tmp = function(option) {
          return (option.val())
            ? $('#faction_ranks_tables').children().eq(option.val()-1)
            : false;
        }
        var index = $(option).data('index');
        var box = tmp($(this).find('option').eq(index));

        if (!isFaction) return false; // TMP HACK

        if (box) $('.ui-selectbox').append(box.clone());

        return false; // Don't bubble up to ensure optgroups are ignored
      },
      menuOpen: function(event, menu) {
        $('.ui-selectbox').remove();
        direction = (isLocation) ? -1 : 1;
        var element = $('<div class="ui-selectbox"></div>')
          .css({
            'height': menu.height() + 'px',
            'width':  menu.width()  + 'px',
            'left':   menu.offset().left + menu.width() * direction + 'px',
            'top':    menu.offset().top + 'px',
            'position': 'absolute'
          })
          .insertBefore(menu)
          .hide()
          .effect('slide', {
            direction: (isLocation) ? 'right' : 'left'
          });
      },
      menuClose: function(event, menu) { $('.ui-selectbox').remove(); },
      format: function(text) {
        return text
          .replace(/(\*+)/,'<span class="stars">$1</span>')
          .replace(/\*/g, '<span class="star">&nbsp;</span>');
      },
    });
  });

  $('#CharacterIsNpc').button();

  // TODO: Clean up
  $("#age input").focus(function () { $("#age_information").slideDown(); });
  $("#age input").blur( function () { $("#age_information").slideUp(); });
  $("#age_information").hide();

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
