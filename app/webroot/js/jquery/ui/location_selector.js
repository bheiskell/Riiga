$.widget('ui.locationSelector', {
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
