$.widget('ui.location_map', {
  options: {
    height: 0,
    width: 0
  },
  _init: function() {
    var o = this.options;

    this.element.wrap('<div class="ui-location"/>');

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

    this.element.clearQueue().animate({
        left: -positionX + 'px',
        top:  -positionY + 'px',
        width:  dimensionX + 'px',
        height: dimensionY + 'px'
      },
      duration
    );
  },
  point: function(x, y) {
  }
});

$.widget('ui.location_selector', {
  _init: function() {
    var self = this;
    this.element
      .mousedown(function(event) { self._start (event); })
      .mousemove(function(event) { self._drag  (event); })
      .mouseup  (function(event) { self._finish(event); })
    ;
  },
  _start: function(event) {
    var self = this;

    this.selector = $('<div class="ui-location-selector"/>')
      .css({
        left: event.pageX + 'px',
        top: event.pageY + 'px'
      })
      .bind('mouseup mousemove', function(e) { self.element.trigger(e) })
      .appendTo('body');

    event.preventDefault();
  },
  _drag: function(event) {
    if (!this.selector) return;

    this.selector.css({
      height: event.pageY - this.selector.offset().top + 'px',
      width:  event.pageX - this.selector.offset().left + 'px'
    });
  },
  _finish: function(event) {
    var offsetMap = this.element.offset();
    var widthMap  = this.element.width();
    var heightMap = this.element.height();
    var offsetBox = this.selector.offset();
    var widthBox  = this.selector.width();
    var heightBox = this.selector.height();

    var percent = {
      x:      100 / widthMap  * (offsetBox.left - offsetMap.left),
      y:      100 / heightMap * (offsetBox.top  - offsetMap.top),
      width:  100 / widthMap  * widthBox,
      height: 100 / heightMap * heightBox
    };

    for (var key in percent) { percent[key] = Math.round(percent[key]); }

    this.options.callbackPosition(
      percent.x,
      percent.y,
      percent.width,
      percent.height
    );

    this.selector.remove();
  }
});
