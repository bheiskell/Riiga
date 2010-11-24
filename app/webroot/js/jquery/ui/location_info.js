$.widget('ui.locationInfo', {
  options: {
    height: 250,
    width:  null,
  },
  _init: function() {
    // undo automatic hiding of data
    this.element.show();

    if (!this.options.width)  { this.options.width  = this.element.width(); }
    if (!this.options.height) { this.options.height = this.options.width; }

    this.map = $('img', this.element).locationMap({
      width:  this.options.width,
      height: this.options.height
    });

    // hide all region / point data
    $('dl', this.element).hide();

    // hide all the information divs but show the map
    this.element.children().hide();
    this.map.show()
  },
  select: function(location_id) {
    if (!location_id) return;

    this.element.children().hide();
    this.map.parent().show();

    var content = $('.LocationId_' + location_id, this.element).show();
    var coordinates = $('dl', content);

    this.map.locationMap(
      'region',
      parseInt($('dt:contains("Left")',   coordinates).next().text()),
      parseInt($('dt:contains("Top")',    coordinates).next().text()),
      parseInt($('dt:contains("Width")',  coordinates).next().text()),
      parseInt($('dt:contains("Height")', coordinates).next().text()),
      1000
    );
    /* TODO Point data
    this.map.locationMap(
      'point',
      parseInt($('dt:contains("X")', coordinates).next().text()),
      parseInt($('dt:contains("Y")', coordinates).next().text()),
    );*/
  }
});
