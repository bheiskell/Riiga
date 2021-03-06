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
    subrace:     $('#CharacterSubraceId'),
    location:    $('#CharacterLocationId'),
    age:         $('#CharacterAge'),
    faction:     $('#CharacterFactionId'),
    factionRank: $('#CharacterFactionRankId'),
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
    profession: $('#ProfessionInformation'),
    subrace:    $('#SubraceInformation')
  }

  $().add(elements.race).add(elements.location).flattenOptgroups();

  new Rules(elements).apply();

  // Hide informational divs
  for (var key in informations) { informations[key].hide(); }

  // Apply widgets
  elements.rank.star();
  elements.isNpc.checkbuttons({
    messageOff: 'Player Character',
    messageOn:  'Non-player Character'
  });

  elements.age.ageInfo({
    info: informations.age,
    race: elements.race,
  });

  elements.profession.professionInfo({
    categories: informations.profession,
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

  elements.race.selectsubmenu({
    format: filterStars,
    fillSubmenu: function(o, submenu) {
      submenu.children().remove();
      if (!o.val()) return;

      var content = $('.RaceId_' + o.val(), informations.race).clone();

      // Hack to get the image height so that the block renders correctly
      var image = $('.RaceId_' + o.val() + ' img', informations.race)[0];

      submenu.append(content).clearQueue().css({
        height: submenu.children().outerHeight() + image.height,
        width:  submenu.children().outerWidth()
      });
    }
  });

  elements.subrace.selectsubmenu({
    fillSubmenu: function(o, submenu) {
      submenu.children().remove();
      if (!o.val()) return;

      var content = $('.SubraceId_' + o.val(), informations.subrace).clone();

      submenu.append(content).clearQueue().css({
        height: submenu.children().outerHeight(),
        width:  submenu.children().outerWidth()
      });
    }
  });

  elements.location.selectsubmenu({
    format: filterStars,
    fillSubmenu: function(o, submenu) {
      if (0 == submenu.children().length) {
        submenu.append(informations.location.clone());
        submenu.children().locationInfo({
          width: 400,
          height: 250
        });
      }
      submenu.children().locationInfo('select', o.val());
      submenu.clearQueue().css({
        height: submenu.children().outerHeight(),
        width:  submenu.children().outerWidth()
      });
    }
  });

  elements.faction.selectsubmenu({
    fillSubmenu: function(o, submenu) {
      submenu.children().remove();
      if (!o.val()) return;

      var content = $('.FactionId_' + o.val(), informations.faction).clone();

      $('table', content).hide();

      submenu.append(content).clearQueue().css({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    }
  });

  elements.factionRank.selectsubmenu({
    fillSubmenu: function(o, submenu) {
      submenu.children().remove();

      var factionId = elements.faction.val();

      if (!o.val() || !factionId) return;

      var content = $('.FactionId_' + factionId, informations.faction).clone();

      $('p', content).hide();

      submenu.append(content).clearQueue().css({
        height: content.outerHeight(),
        width:  content.outerWidth()
      });
    },
    // All the faction ranks displayed at once is too overwhelming. Only show
    // the ranks for the current faction. This is a bit gross
    preopen: function() {
      var factionName = $('option:selected', elements.faction)
        .text()
        .replace(/ /g, '_');

      $('#CharacterFactionRankId-menu')
        .children(':not(:first)')
        .show()
        .not('.ui-selectsubmenu-group-' + factionName)
        .hide();
    }
  });

  // Hack: event triggering is too complicated to identify the issue here. So
  // I'm tacking on this change event to resolve another issue. Issue at hand
  // is cakephp will default to the last instance of an option when listed in
  // multiple optgroups. When the optgroups are disabled via javascript, this
  // results in an invalid field. That invalid field with then not be passed to
  // the server and subsequently blackhole the request. If this doesn't scream
  // refactor me, I don't know what does : (
  elements.faction.change(function () {
    var option = $('option:selected', this);
    if (option.attr('disabled')) {
      var newOption
        = $('option:[value='+option.val()+']', this).filter(':not(:disabled)');
      if (newOption.length) {
        option.attr('selected', false);
        newOption.attr('selected', 'selected');
        $(this).trigger('change');
      }
    }
  }).trigger('change');
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
    this.t.rank       .bind('limit', this._limitByUserRank);
    this.t.race       .bind('limit', this._limitByRank);
    this.t.subrace    .bind('limit', this._limitByRace);
    this.t.location   .bind('limit', this._limitByRank);
    this.t.faction    .bind('limit', this._limitByRace);
    this.t.factionRank.bind('limit', this._limitByFaction);
    this.t.factionRank.bind('limit', this._limitByAgeAndLevel);

    // Rules are propagated by triggering dependents on a change
    this.t.userRank.change(function() {
      self.t.rank.trigger('limit', [this]).trigger('change');
    });
    this.t.rank.change(function() {
      self.t.race    .trigger('limit', [this]).trigger('change');
      self.t.location.trigger('limit', [this]).trigger('change');
    });
    this.t.race.change(function() {
      self.t.subrace.trigger('limit', [this]).trigger('change');
      self.t.faction.trigger('limit', [this]).trigger('change');
    });
    this.t.age.change(function() {
      self.t.faction.trigger('change');
    });
    this.t.faction.change(function() {
      self.t.factionRank.trigger('limit', [this, self.t.age, self.t.rank]);
    });
  };

  this.destroy = function() {
    this.t.rank        .unbind('limit');
    this.t.race        .unbind('limit');
    this.t.faction     .unbind('limit');
    this.t.factionRank .unbind('limit');
    this.t.location    .unbind('limit');
    this.t.subrace     .unbind('limit');
    this.t.userRank    .unbind('change');
    this.t.rank        .unbind('change');
    this.t.race        .unbind('change');
    this.t.age         .unbind('change');
    this.t.faction     .unbind('change');
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

    $('option', this).removeAttr('disabled');
    $('optgroup[label!='+ raceName +'] option', this)
      .attr('disabled', 'disabled');
    self._resetIfDisabled(this);
  };

  this._limitByFaction = function(event, faction) {
    var factionName = $('option:selected', faction).text()

    $('option', this).removeAttr('disabled');
    $('optgroup[label!='+ factionName +'] option', this)
      .attr('disabled', 'disabled');
    self._resetIfDisabled(this);
  };

  /**
   * Pretty hack implementation of the faction ranks rule. Breaks the
   * encapsulation by referencing the rule data via .FactionId_##
   */
  this._limitByAgeAndLevel = function(event, faction, age, rank) {
    var factionName = $('option:selected', faction).text()
    var factionId = $(faction).val();

    var rows = $('.FactionId_' + factionId + ' table tbody tr');

    var lastValidAge = false, lastValidRank = false;

    rows.each(function() {
      var rankName = $('td', this).eq(0).text();
      var rowRank  = parseInt($('td', this).eq(1).text(), 10);
      if (rank.val() >= rowRank) { lastValidRank = rankName; }

      var rowAge   = parseInt($('td', this).eq(2).text(), 10);
      var curAge   = parseInt(age.val(), 10);
      if (curAge >= rowAge)  { lastValidAge  = rankName; }
    });
    var optgroup = $('optgroup[label='+factionName+']', this);

    $('option', optgroup).attr('disabled', 'disabled');

    var r = $('option:contains('+lastValidRank+')', optgroup).prevAll().andSelf();
    var a = $('option:contains('+lastValidAge +')', optgroup).prevAll().andSelf();
    if (r.length > a.length) { a.removeAttr('disabled'); }
    else                     { r.removeAttr('disabled'); }

    self._resetIfDisabled(this);
  };

  /**
   * Options disabled by JS will not automatically be unselected by a select
   * box. This will default to the first option.
   */
  this._resetIfDisabled = function(select) {
    var value = $(select).find('option:selected').val();
    if (!value
      || 0 == $('option[value='+value+']', select)
                .filter(':not(:disabled)')
                .length
    ) {
      $(select).val($('option:first', $(select)).val()).trigger('change');
    }
  }

  this._init();
}
