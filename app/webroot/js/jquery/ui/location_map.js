$.widget('ui.locationMap', {
  options: {
    height: 0,
    width: 0
  },
  _init: function() {
    var self = this;
    // Wait until the image is loaded to initialize
    if (this.element[0].complete) {
      this._load();
    } else {
      this.element.load(function() { self._load(); });
    }
  },
  _load: function() {
    var o = this.options;

    this.element.wrap('<div class="ui-location-map"/>');

    o.height = (o.height) ? o.height : this.element[0].height;
    o.width  = (o.width)  ? o.width  : this.element[0].width;

    this.imgWidth  = this.element[0].width;
    this.imgHeight = this.element[0].height;

    this.element.parent().css({
      height: o.height + 'px',
      width:  o.width  + 'px'
    });

    this.region(0, 0, 100, 100, 0);
  },
  destroy: function() {
    this.element.unwrap();
  },
  // Normalize percents to image pixels.
  _translate: function(percentX, percentY) {
    return {
      x: this.imgWidth  * percentX / 100.0,
      y: this.imgHeight * percentY / 100.0
    };
  },
  region: function(x, y, width, height, duration) {
    // Because container is in pixels convert from percents
    var position  = this._translate(x, y);
    var dimension = this._translate(width, height);
    // Zoom based on ratio of container to region dimension
    var zoomX = this.options.width  / dimension.x;
    var zoomY = this.options.height / dimension.y;
    // Use smaller zoom to ensure full map in sight
    var zoom    = (zoomX < zoomY) ? zoomX : zoomY;
    // When zooming on one dimension, offset the other to centered focal point
    var offsetX = (zoomX < zoomY) ? 0 : (zoomX - zoomY) * dimension.x / 2;
    var offsetY = (zoomX > zoomY) ? 0 : (zoomY - zoomX) * dimension.y / 2;
    // Top left position taking into account offset
    var positionX = position.x * zoom - offsetX;
    var positionY = position.y * zoom - offsetY;
    // Image size, not container, needs to be used for zooming
    var dimensionX = this.imgWidth * zoom;
    var dimensionY = this.imgHeight * zoom;

    var css = {
      left: -positionX + 'px',
      top:  -positionY + 'px',
      width:  dimensionX + 'px',
      height: dimensionY + 'px'
    };

    // Performance on IE is horrible. IE users don't get this feature :-)
    if ($.browser.msie) {
      this.element.css(css);
    } else {
      this.element.clearQueue().animate(css, duration);
    }
  },
  point: function(x, y) {
  }
});
