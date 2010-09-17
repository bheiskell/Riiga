/**
 * Character generation wizard.
 *
 * Takes the character form outputted by the new and edit pages and transforms
 * it dynamically to add helper information.
 */
$(document).ready(function() {
  var elements = {
    userRank:    $('#CharacterUserRank'),
    rank:        $('#CharacterRankId'),
    race:        $('#CharacterRaceId'),
    location:    $('#CharacterLocationId'),
    age:         $('#CharacterAge'),
    faction:     $('#CharacterFactionId'),
    profession:  $('#CharacterProfession'),
    description: $('#CharacterDescription'),
    history:     $('#CharacterHistory'),
    isNpc:       $('#CharacterIsNpc')
  };
  var informations = {
    race:       $('#RaceInformation'),
    location:   $('#LocationInformation'),
    age:        $('#AgeInformation'),
    faction:    $('#FactionInformation'),
    profession: $('#ProfessionInformation')
  }

  $().add(elements.race).add(elements.location).flattenOptgroups();

  new Rules(elements).apply();

  // Hide informational divs
  for (var key in informations) { informations[key].hide(); }

  // Apply widgets
  elements.rank.star();
  elements.description.autoResize().trigger('change.dynSiz');
  elements.history    .autoResize().trigger('change.dynSiz');
  elements.isNpc.checkbuttons({
    messageOff: 'Player Character',
    messageOn:  'Non-player Character'
  });


////////////////////////////////////////////////////////////////////////////////

  // reformat age information html
  $('h3', informations.age).remove();
  $('tr', informations.age)
    .removeClass('altrow')
    .each(function() { $('th:first', this).remove(); });

  elements.age.parent().after(informations.age);

  elements.age.focus(function () {
    var ages = $('.RaceId_' + elements.race.val(), informations.age);

    ages.show().siblings().hide();

    if (ages.length == 1) { informations.age.slideDown(); }
  });

  elements.age.blur( function () { informations.age.slideUp(); });

  /**
   * Pull optgroup level from data and convert to stars, e.g., 2 -> **. This
   * format is used by the format function to generate star icons.
   */
  $().add(elements.race).add(elements.location).each(function() {
    $('option', this).each(function() {
      var optgroup = $(this).data('optgroup');
      if (optgroup) {
        var rank = parseInt(optgroup.replace(/Level /, ''));
        var stars = new Array(rank + 1).join('*');
        $(this).text($(this).text() + stars);
      }
    });
  });

  var filterStars = function(text) {
    return text
      .replace(/(\*+)/, '<span class="stars">$1</span>')
      .replace(/\*/g, '<span class="star">&nbsp;</span>');
  }

  elements.race.select({
    format: filterStars,
    fillSubmenu: function(o, submenu) {
      if (!o.val()) return;

      var content = $('#RaceInformation .RaceId_' + o.val()).clone();

      submenu.append(content).clearQueue().animate({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    }
  });

  elements.location.select({
    format: filterStars,
    submenuPosition: 'left',
    fillSubmenu: function(o, submenu) {
      if (!o.val()) return;

      var content = $('#LocationInformation .LocationId_' + o.val()).clone();

      submenu.append(content).clearQueue().animate({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    }
  });

  elements.faction.select({
    fillSubmenu: function(o, submenu) {
      if (!o.val()) return;

      var content = $('#FactionInformation .FactionId_' + o.val()).clone();

      submenu.append(content).clearQueue().animate({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    }
  });
////////////////////////////////////////////////////////////////////////////////

  // Convert professions into a traversable data-structure.
  var categories = [ ];
  $('#ProfessionInformation h4').each(function() {
    var category = {
      name: $(this).text(),
      professions: [ ]
    };

    $(this).siblings('div').children('h5').each(function() {
      var profession = {
        name: $(this).text(),
        races: [ ]
      };

      var races = $(this).siblings('table').find('tr td:first-child');

      races.each(function() {
        var race =  {
          name: $(this).text(),
          age: parseInt($(this).next().text())
        };

        var id = parseInt($(this).attr('class').replace(/[^0-9]+/,''));

        profession.races[id] = race;
      });
      category.professions.push(profession);
    });
    categories.push(category);
  });

  var elementsData = $('<div></div>').insertAfter(elements.profession);
  elements.profession.blur(function() {

  });
////////////////////////////////////////////////////////////////////////////////
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
    $('option[value=' + $(userRank).val() + ']', this)
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
    var raceName = $('option:selected', race).text().replace(/\*+/, '');

    $('option:not(:first)', this).attr('disabled', 'disabled');
    $('optgroup[label='+ raceName +'] option', this)
      .removeAttr('disabled');
    self._resetIfDisabled(this);
  };

  /**
   * Options disabled by JS will not automatically be unselected by a select
   * box. This will default to the first option.
   */
  this._resetIfDisabled = function(select) {
    if ($(select).find('option:selected').attr('disabled')) {
      $(select).val($('option:first', $(select)).val()).trigger('change');
    }
  }

  this._init();
}

/**
 * Quickly written widget that converts a checkbox to two buttons.
 */
$.widget('ui.checkbuttons', {
  options: {
    messageOff: 'Off',
    messageOn:  'On'
  },
  _init: function() {
    var self = this, id = this.element.attr('id');

    var inputOff = $('<input type="radio" value="0" />');
    var inputOn  = $('<input type="radio" value="1" />');

    var labelOff = $('<label></label>').text(this.options.messageOff);
    var labelOn  = $('<label></label>').text(this.options.messageOn);

    inputOff.attr('name', id + 'Radio').attr('id', id + 'Off');
    inputOn .attr('name', id + 'Radio').attr('id', id + 'On');

    inputOff.attr('checked', !this.element.attr('checked'));
    inputOn .attr('checked',  this.element.attr('checked'));

    inputOff.change(function() { self.element.attr('checked', false); })
    inputOn .change(function() { self.element.attr('checked', true); })

    labelOff.attr('for', inputOff.attr('id'));
    labelOn .attr('for', inputOn .attr('id'));

    this.radios = $('<div></div>')
      .append(inputOff)
      .append(labelOff)
      .append(inputOn)
      .append(labelOn)
      .buttonset()
      .insertAfter(this.element.parent());

    this.element.parent().hide();
  },
  _destroy: function() {
    this.radios.remove();
    this.element.parent().show();
  }
});

/**
 * Extend selectmenu as select to add required functionality not supported by
 * the base selectmenu. Such features include minor bug fixes / tweaks, Adding
 * a slide out menu with callbacks, and adding support for individual options
 * to be disabled.
 */
$.widget('ui.select', $.ui.selectmenu, {
  options: {
    style: 'dropdown',
    menuWidth: 0,
    submenuPosition: 'right',
    submenuWidth: 0,
    submenuHeight: 0
  },

  _init: function() {
    var self = this;
    $.ui.selectmenu.prototype._init.call(this);

    // by default selectmenu ignores padding width which we need included
    if (!this.options.menuWidth) this.list.width(this.newelement.innerWidth());

    this.element.change(function() { self._updateDisabledFields(); });

    $('li', this.list).mouseover(function(event) { self._hover(event) });

    this._updateDisabledFields();
  },

  /* Add submenu slide out */
  open: function(event) {
    $(document).trigger('mousedown'); // close other open selectmenus

    $.ui.selectmenu.prototype.open.call(this);

    var submenuCss = {
      'height': (this.options.submenuHeight || this.list.height()),
      'width':  (this.options.submenuWidth  || this.list.width()),
      'top':    this.list.offset().top
    }

    if ('right' == this.options.submenuPosition) {
      submenuCss.left = this.list.offset().left + this.list.innerWidth();
    } else {
      submenuCss.left = this.list.offset().left - submenuCss.width;
    }

    var slideFromLeft = ('right' == this.options.submenuPosition);

    var conf = ('right' == this.options.submenuPosition)
    this.submenu = $('<div class="ui-select-submenu"></div>')
      .css(submenuCss)
      .mousedown(function(event) { event.stopPropagation(); })
      .insertBefore(this.list)
      .hide()
      .effect('slide', { direction: (slideFromLeft) ? 'left' : 'right' });
  },

  /* Provide a hover callback for obtaining submenu content */
  _hover: function(event) {
    this.submenu.children().remove();

    var index = $(event.currentTarget).data('index');
    if (index) {
      var option = $('option', this.element).eq(index);

      if (this.options.fillSubmenu) {
        var contents = this.options.fillSubmenu(option, this.submenu);
      }

      event.stopPropagation();
    }
  },

  /* Add support for disabled options */
  _updateDisabledFields: function() {
    var options = $('option', this.element);

    $('li', this.list).each(function() {
      var disabled = options.eq($(this).data('index')).attr('disabled');

      if (disabled) {
        $(this).addClass('ui-state-disabled');
      } else {
        $(this).removeClass('ui-state-disabled');
      }
    });

    this._refreshValue();
  },
  value: function(index) {
    if (arguments.length) this.disabledOptionSelected = 
      $('option', this.element).eq(index).attr('disabled');

    return (!this.disabledOptionSelected && arguments.length)
      ? $.ui.selectmenu.prototype.value.call(this, index)
      : $.ui.selectmenu.prototype.value.call(this);
  },
  close: function(event, retainFocus) {
    if (retainFocus && this.disabledOptionSelected) return;

    if (this.submenu) this.submenu.remove();

    return $.ui.selectmenu.prototype.close.call(this, event, retainFocus);
  },

  /* Empty options do not render correctly. Fixing this bug here. */
  _formatText: function(text){
    if ('' == text) text = '&nbsp;';

    return $.ui.selectmenu.prototype._formatText.call(this, text);
  }
});
