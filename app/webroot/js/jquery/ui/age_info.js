$.widget('ui.ageInfo', {
  options: {
    info: false,
    race: false
  },
  _init: function() {
    var self = this;

    this.options.info.addClass('ui-age-info');

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
