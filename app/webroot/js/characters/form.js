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

  elements.age.age({
    info: informations.age,
    race: elements.race,
  });

  elements.profession.profession({
    categories: getCategories(informations.profession),
    race: elements.race,
    age: elements.age
  });

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
      submenu.children().remove();
      if (!o.val()) return;

      var content = $('.RaceId_' + o.val(), informations.race).clone();

      // Hack to get the image height so that the block renders correctly
      var image = $('.RaceId_' + o.val() + ' img', informations.race)[0];

      submenu.append(content).clearQueue().animate({
        height: submenu.children().outerHeight() + image.height,
        width:  submenu.children().outerWidth()
      });
    }
  });

  elements.location.select({
    format: filterStars,
    fillSubmenu: function(o, submenu) {

      var map;
      if (0 == submenu.children().length) {
        map = $('img', informations.location).clone().location_map({
          width:  400,
          height: 200
        }).parent();
      } else {
        map = submenu.children(':first').detach();
      }

      submenu.children().remove().end().append(map);
      $('img', submenu).location_map('region', 0, 0, 100, 100, 1000);

      if (!o.val()) return;

      var content =$('.LocationId_' + o.val(), informations.location).clone();

      $('dl', content).hide();

      submenu.append(content).clearQueue().animate({
        height: content.outerHeight() + map.outerHeight(),
        width:  content.outerWidth()
      });

      $('img', submenu).location_map(
        'region',
        parseInt($('dt:contains("Left")', content).next().text()),
        parseInt($('dt:contains("Top")', content).next().text()),
        parseInt($('dt:contains("Width")', content).next().text()),
        parseInt($('dt:contains("Height")', content).next().text()),
        1000
      );
    }
  });

  elements.faction.select({
    fillSubmenu: function(o, submenu) {
      submenu.children().remove();
      if (!o.val()) return;

      var content = $('.FactionId_' + o.val(), informations.faction).clone();

      submenu.append(content).clearQueue().animate({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    }
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
    var rank = $(userRank).val();

    // When rank is set to 0, the user is brand new. Default to rank 1 star.
    if ('0' == rank) { rank = '1'; }

    $('option[value=' + rank + ']', this)
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
  destroy: function() {
    this.radios.buttonset('destroy');
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

    // by default selectmenu ignores padding width which we need included. also
    // need to half the space for the submenu to use.
    if (!this.options.menuWidth) {
      this.list.width(this.newelement.innerWidth()/2);
    }

    this.element.change(function() { self._updateDisabledFields(); });

    $('li', this.list).mouseover(function(event) { self._hover(event) });

    this._updateDisabledFields();
  },

  /* Add submenu slide out */
  open: function(event) {
    $(document).trigger('mousedown'); // close other open selectmenus

    $.ui.selectmenu.prototype.open.call(this);

    var submenuCss = {
      height: (this.options.submenuHeight || this.list.height()),
      width:  (this.options.submenuWidth  || this.list.width()),
      top:    this.list.offset().top
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

/**
 * Parses HTML and retuns profession information in the format needed by the
 * profession widget.
 */
function getCategories(professionInfo) {
  var categories = [ ];
  $('h4', professionInfo).each(function() {
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

  return categories;
}

/**
 * Professions widget
 * This isn't really intended to be reused. Instead I'm just trying to
 * encapsulate some functionality. Race and age could be call backs, but
 * passing raw jQuery objects is just more to the point. Categories is of the
 * following format:
 *
 *   categories[category_id].professions[profession_id].race[race_id].age;
 * 
 * Each JSON component has a name key for identifying the category, profession,
 * and race:
 *   categories[category_id].name;
 *   categories[category_id].professions[profession_id].name;
 *   categories[category_id].professions[profession_id].race[race_id].name;
 */
$.widget('ui.profession', {
  options: {
    categories: false, // custom JSON structure for the profession's widget
    race:       false, // jquery object that .val will return current race id
    age:        false  // jquery object that .val will return current age
  },
  _init: function() {
    var self = this;

    this.element.parent().css('overflow', 'visible');

    this.data = $('<div></div>')
      .addClass('ui-profession')
      .addClass('ui-widget')
      .addClass('ui-widget-content')
      .addClass('ui-corner-bottom')
      .addClass('ui-shadow')
      .css({
        width: this.element.innerWidth() + 'px',
        top: this.element.innerHeight() + this.element.position().top + 'px'
      })
      .insertAfter(this.element);

    $('<h5>Profession Ideas</h5>')
      .addClass('ui-widget-header')
      .appendTo(this.data);

    this.categoriesList = $('<ul></ul>')
      .addClass('ui-profession-categories')
      .appendTo(this.data);

    this.professionsList = $('<ul></ul>')
      .addClass('ui-profession-professions')
      .appendTo(this.data);

    $('<p></p>')
      .text( 'Tip: Hover over grey (not recommended) professions for details')
      .appendTo(this.data);

    for (var c = 0; c < this.options.categories.length; c++) {
      $('<li></li>')
        .addClass('ui-state-default')
        .text(this.options.categories[c].name)
        .data('id', c)
        .hover(
          function() { $(this).addClass('ui-state-hover'); },
          function() { $(this).removeClass('ui-state-hover'); }
        )
        .appendTo(this.categoriesList)
        .mouseover(function(event) { self._categoryMouseOver(event); });
    }

    this.data.mouseleave(function() {
      self.professionsList.children().remove();
    });

    this.data.hide();

    this.element.focus(function() { self.data.slideDown(); });
    this.element.blur( function() { self.data.slideUp(); });
  },

  destroy: function() {
    this.data.remove();
    this.element.unbind('focus blur');
  },

  _categoryMouseOver: function(event) {
    var self = this;
    var categories = this.options.categories;
    var c = $(event.target).data('id');

    this.professionsList.children().remove();

    this._sortProfessions(c);

    for (var p = 0; p < categories[c].professions.length; p++) {
      var r = this.options.race.val();
      var race = categories[c].professions[p].races[r];

      var raceEnabled = undefined != race;
      var ageEnabled  = undefined != race && race.age <= this.options.age.val();

      var profession = $('<li></li>')
        .text(categories[c].professions[p].name)
        .click(function() { self.element.val($(this).text()); })
        .appendTo(this.professionsList);

      // when race is disabled, age info is overriden
      if (!ageEnabled) profession
          .removeClass()
          .addClass('ui-limited-by-age')
          .attr('title', 'Should be at least '+(race && race.age)+' years old');
      if (!raceEnabled) profession
          .removeClass()
          .addClass('ui-limited-by-race')
          .attr('title', 'Profession not avaliable for your race');
    }
  },

  /* Sort by age and race availability */
  _sortProfessions: function(category) {
    var self = this;

    this.options.categories[category].professions
      .sort(function(left, right) {
        var age  = self.options.age.val();
        var race = self.options.race.val();

        var leftRace  = undefined != left.races[race];
        var rightRace = undefined != right.races[race];

        var leftAge  = left.races[race]  && left.races[race].age  <= age;
        var rightAge = right.races[race] && right.races[race].age <= age;

        if (leftRace != rightRace) return (leftRace) ? -1 : 1;
        if (leftAge  != rightAge)  return (leftAge)  ? -1 : 1;
        return (left.name < right.name) ? -1 : 1;
      });
  }
});

/* Age widget */
$.widget('ui.age', {
  options: {
    info: false,
    race: false
  },
  _init: function() {
    var self = this;

    // restructure table
    $('h3', this.options.info).remove();
    $('tr', this.options.info)
      .removeClass('altrow')
      .each(function() { $('th:first', this).remove(); });

    this.element.parent().after(this.options.info);

    this.element.blur( function () { self.options.info.slideUp(); });
    this.element.focus(function () {
      var ages = $('.RaceId_' + self.options.race.val(), self.options.info);

      ages.show().siblings().hide();

      if (ages.length == 1) { self.options.info.slideDown(); }
    });
  }
});
