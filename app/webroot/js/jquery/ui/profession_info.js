/**
 * Professions widget
 * This isn't really intended to be reused. Instead I'm just trying to
 * encapsulate some functionality. Race and age could be call backs, but
 * passing raw jQuery objects is just more to the point.
 */
$.widget('ui.professionInfo', {
  options: {
    categories: false, // custom HTML structure for the profession's widget
    race:       false, // jquery object that .val will return current race id
    age:        false  // jquery object that .val will return current age
  },
  _init: function() {
    var self = this;

    this.categories = this._translate(this.options.categories);

    this.element.parent().css('overflow', 'visible');

    this.data = $('<div></div>')
      .addClass('ui-profession-info')
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
      .addClass('ui-profession-info-categories')
      .appendTo(this.data);

    this.professionsList = $('<ul></ul>')
      .addClass('ui-profession-info-professions')
      .appendTo(this.data);

    $('<p></p>')
      .text( 'Tip: Hover over grey (not recommended) professions for details')
      .appendTo(this.data);

    for (var c = 0; c < this.categories.length; c++) {
      $('<li></li>')
        .addClass('ui-state-default')
        .text(this.categories[c].name)
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
    var categories = this.categories;
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

    this.categories[category].professions
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
  },

  _translate: function(professionInfo) {
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
});
