<div class="locations form">
<?php echo $form->create('Location');?>
  <fieldset>
    <legend><?php __('Edit Location');?></legend>
  <?php
    $html->css('jquery-cust_select_box.css', null, null, false);
    $javascript->link('jquery-cust_select_box.js', false);
    $javascript->link('location_tags.js', false);

    echo $form->hidden('id');
    echo $form->input('name');
    echo $form->input('description');
    echo $form->input('parent_id', array('empty' => true));
    echo $form->input('LocationTag', array(
      'empty'   => 'Add Tags',
      'between' => '<div class="select_wrap">',
      'after'   => '</div>',
    ));
    echo $form->input('LocationRegion.id');
    echo $form->input('LocationRegion.left');
    echo $form->input('LocationRegion.top');
    echo $form->input('LocationRegion.width');
    echo $form->input('LocationRegion.height');
  ?>
  </fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
  <ul>
    <li>
      <?php
        echo $html->link(
          __('Delete', true),
          array('action' => 'delete', $form->value('Location.id')),
          null,
          sprintf(
            __('Are you sure you want to delete # %s?', true),
            $form->value('Location.id')
          )
        );
      ?>
    </li>
    <li>
      <?php
        echo $html->link(
          __('List Locations', true), array('action' => 'index')
        );
      ?>
    </li>
  </ul>
</div>

<?php echo $html->image('map/riiga.jpg'); ?>
<script>
$.widget('ui.location', {
  options: {
    height: 0,
    width: 0
  },
  _init: function() {
    var self = this, o = this.options;

    this.element.wrap('<div class="ui-location"/>');

    this.element.load(function() {
      o.height = (o.height) ? o.height : this.height;
      o.width  = (o.width)  ? o.width  : this.width;

      self.imgWidth  = this.width;
      self.imgHeight = this.height;

      self.element.parent().css({
        height: o.height + 'px',
        width:  o.width  + 'px'
      });

      self.position(0, 0, 100, 100, 0);
    });
  },
  destroy: function() {
  },
  // Normalize percents to image pixels.
  _translate: function(percentX, percentY) {
    return {
      x: this.imgWidth  * percentX / 100.0,
      y: this.imgHeight * percentY / 100.0
    };
  },
  position: function(x, y, width, height, duration) {
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

    this.element.animate({
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

$('img[src$="riiga.jpg"]').location({
  width:  600,
  height: 436
})
.locationSelector({
  callbackPosition: function(x, y, width, height) {
    $('#LocationRegionLeft')  .val(x);
    $('#LocationRegionTop')   .val(y);
    $('#LocationRegionWidth') .val(width);
    $('#LocationRegionHeight').val(height);
  }
});
</script>

