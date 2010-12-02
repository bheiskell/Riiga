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

      submenu.append(content).clearQueue().animate({
        height: submenu.children().outerHeight() + image.height,
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
      submenu.clearQueue().animate({
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
