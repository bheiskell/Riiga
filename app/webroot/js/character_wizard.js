/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */
$(document).ready(function() {
  var elements = {
    userRank: $('#CharacterUserRank'),
    rank:     $('#CharacterRankId'),
    race:     $('#CharacterRaceId'),
    location: $('#CharacterLocationId'),
    age:      $('#CharacterAge'),
    faction:  $('#CharacterFactionId'),
    isNpc:    $('#CharacterIsNpc'),
  };
  var informations = {
    race:       $('#RaceInformation'),
    location:   $('#LocationInformation'),
    age:        $('#AgeInformation'),
    faction:    $('#FactionInformation'),
    profession: $('#ProfessionInformation'),
  }

  $().add(elements.race).add(elements.location).flattenOptgroups();

  new Rules(elements).apply();

  // Hide informational divs
  //for (var key in informations) { informations[key].hide(); }

  // Apply widgets
  elements.rank.star();
  elements.isNpc.button();

  $('h3', informations.age).remove();
  elements.age.parent().after(informations.age);
  $('tr', informations.age).removeClass('altrow').each(function() {
    $('th:first', this).remove();
  });
  /*informations.age.css({
    position: 'absolute',
    width: elements.age.parent().outerWidth() + 'px',
    'z-index': 999
  }).position({
    my: 'top left',
    at: 'top left',
    using: elements.age
  });*/
  elements.age.focus(function () {
    // TODO fix mega hack : )
    if(1==$('tr:not(:first)', informations.age).hide().filter('.RaceId_'+elements.race.val()).show().length)
      informations.age.slideDown();
  });
  elements.age.blur( function () { informations.age.slideUp(); });

////////////////////////////////////////////////////////////////////////////////

// TODO: Merge the following base stuff into select ui. Then add a submenuContents call back that passes an option to a function specified and returns the jquery object that is to be cloned? Deep copy?
  $().add(elements.race).add(elements.location).add(elements.faction)
    .each(function() {
      /**
       * Pull optgroup level from data and convert to stars, e.g., 2 -> **. This
       * format is used by the format function to generate star icons.
       */
      $('option', this).each(function() {
        var optgroup = $(this).data('optgroup');
        if (optgroup) {
          var rank = parseInt(optgroup.replace(/Level /, ''));
          var stars = new Array(rank + 1).join('*');
          $(this).text($(this).text() + stars);
        }
      });

      $(this).select({
        style:           'dropdown',
        submenuPosition: 'right',
        menuWidth:       $(this).outerWidth(),

        menuOpen: function(event, menu) {
          $('.ui-select-submenu').remove();

          var conf = ('right' == $(this).select('option', 'submenuPosition'))
            ? { offset: menu.width() *  1, slide: 'left' }
            : { offset: menu.width() * -1, slide: 'right' };

          $('<div class="ui-select-submenu"></div>').css({
              'height': menu.height() + 'px',
              'width':  menu.width()  + 'px',
              'top':    menu.offset().top + 'px',
              'left':   menu.offset().left + conf.offset + 'px',
            })
            .mousedown(function() { return false; }) // dont close selectmenu
            .insertBefore(menu)
            .hide()
            .effect('slide', { direction: conf.slide });
        },
        menuClose: function(event, menu) {
          $('.ui-select-submenu').remove();
        },

        format: function(text) {
          return text
            .replace(/(\*+)/, '<span class="stars">$1</span>')
            .replace(/\*/g, '<span class="star">&nbsp;</span>');
        },
      });
    });

    $(elements.location).select('option', 'submenuPosition', 'left');
    $(elements.faction).select('option', 'submenuContents', function(option) {
      return (option.val())
        ? $('#FactionInformation').children('.FactionId_' + option.val())
        : false;
    });

    $(elements.faction).bind('selectmenuhover', function(event, option) {
      $('.ui-select-submenu').children().remove();

      // TMP HACK
      var submenuContents = $(this).select('option', 'submenuContents');

      if (!submenuContents) { return false; }

      var index = $(option).data('index');

      var box = submenuContents($('option', this).eq(index));

      if (box) $('.ui-select-submenu').append(box.clone());

      return false; // Don't bubble up to ensure optgroups are ignored
    });
});

/**
 * Sometimes optgroups are too visually cluttered. Remove them and transfer the
 * label to a jQuery data entry called optgroup.
 */
$.fn.flattenOptgroups = function() {
  return this.each(function() {
    $('option', this).each(function() {
      $(this).data('optgroup', $(this).parent('optgroup').attr('label') || '');
    });
    $('optgroup option', this).clone(true).appendTo(this);
    $('optgroup', this).remove();
  });
};

/**
 * Apply Character wizard rules to a json set of jQuery targets.
 */
function Rules(targets) {
  var self = this;

  this.t = targets;

  this._init = function() {

    // Bind a function for disabling entries
    this.t.rank    .bind('limit', this._limitByUserRank);
    this.t.race    .bind('limit', this._limitByRank);
    this.t.location.bind('limit', this._limitByRank);
    this.t.faction .bind('limit', this._limitByRace);

    // Rules are propagated by triggering dependents on a change
    this.t.userRank.change(function() {
      self.t.rank.trigger('limit', [this]).trigger('change');
    });
    this.t.rank.change(function() {
      self.t.race    .trigger('limit', [this]).trigger('change');
      self.t.location.trigger('limit', [this]).trigger('change');
    });
    this.t.race.change(function() {
      self.t.faction.trigger('limit', [this]).trigger('change');
    });
    this.t.age.change(function() {
      self.t.faction.trigger('change');
    });
  };

  this.destroy = function() {
    this.t.rank    .unbind('limit');
    this.t.race    .unbind('limit');
    this.t.faction .unbind('limit');
    this.t.location.unbind('limit');
    this.t.userRank.unbind('change');
    this.t.rank    .unbind('change');
    this.t.race    .unbind('change');
    this.t.age     .unbind('change');
  };

  // Trigger top level rule
  this.apply = function() {
    this.t.userRank.trigger('change');
    return this;
  };

  // CakePHP doesn't support disabling individual option tags. Hack it into JS.
  this._limitByUserRank = function(event, userRank) {
    $('option[value='+$(userRank).val()+']', this)
      .nextAll()
      .attr('disabled', 'disabled');
  };

  this._limitByRank = function(event, rank) {
    $('option', this).removeAttr('disabled').each(function() {
      var optRank = $(this).data('optgroup').replace(/Level /, '');
      if ($(rank).val() < optRank) {
        $(this).attr('disabled', 'disabled');
      }
    });
    self._resetIfDisabled(this);
  };

  this._limitByRace = function(event, race) {
    var raceName = $('option:selected', race).text();

    $('option:not(:first)', this).attr('disabled', 'disabled');
    $('optgroup[label='+ raceName +'] option', this)
      .removeAttr('disabled');
    self._resetIfDisabled(this);
  };

  /**
   * Options disabled by JS will not automatically be unselected by a select
   * box. This will default to the first
   */
  this._resetIfDisabled = function(select) {
    if ($(select).find('option:selected').attr('disabled')) {
      $(select).val($('option:first', $(select)).val()).trigger('change');
    }
  }

  this._init();
}


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
    this.element.change(function() { self.setDisabled(); });
    if ('' == $('option:first', this).text()) {
      $('option:first', this).text('&nbsp;');
    }
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
