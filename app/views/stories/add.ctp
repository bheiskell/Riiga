<div class="stories form">
<?php echo $form->create('Story');?>
  <fieldset>
    <legend><?php __('Add Story');?></legend>
  <?php
    echo $form->input('name');
    echo $form->input('is_invite_only');
    echo $form->input('location_id');
    echo $form->input('User');
    echo $form->input('Character');
    echo $form->input('user_id_turn', array('options' => $turns));
  ?>
  <?php echo $html->image('map/riiga.jpg'); ?>
  </fieldset>
<?php echo $form->end('Submit');?>

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
$('img[src$="riiga.jpg"]').location({
  width:  600,
  height: 536
})
.load(function () {
  $(this)
    .location('position', 0,0,50,50, 1000)
    .location('position', 50,0,50,50, 1000)
    .location('position', 50,50,50,50, 1000)
    .location('position', 0,50,50,50, 1000)
    .location('position', 0,0,50,50, 1000)
    .location('position', 0,0,100,100, 1000)
})
.mousedown(function(event) {
  var self = this;
  event.preventDefault();
  $('<div id="overlay"/>').css({
    position: 'absolute',
    border: '1px dotted grey',
    left: event.pageX + 'px',
    top: event.pageY + 'px'
  })
  .bind('mouseup mousemove', function(event) { $(self).trigger(event) })
  .appendTo('body');
})
.mouseup(function(event) {
  var offsetMap = $(this).offset();
  var widthMap = $(this).width();
  var heightMap = $(this).height();
  var offsetBox = $('#overlay').offset();
  var widthBox = $('#overlay').width();
  var heightBox = $('#overlay').height();

  var percent = {
    x: 100 * (offsetBox.left - offsetMap.left) / widthMap,
    y: 100 * (offsetBox.top  - offsetMap.top)  / heightMap,
    width:  100 * widthBox  / widthMap,
    height: 100 * heightBox / heightMap
  };
  for (var key in percent) { percent[key] = Math.round(percent[key]); }

  //alert(percent.x +' '+ percent.y +' '+ percent.width +' '+ percent.height);
  $(this)
    .location('position', percent.x, percent.y, percent.width, percent.height, 1000)
    .location('position', 0,0,100,100, 2000);

  $('#overlay').remove();
})
.mousemove(function(event) {
  var offset = $('div#overlay').offset();
  if (offset) {
    $('#overlay').css({
      height: event.pageY - offset.top + 'px',
      width:  event.pageX - offset.left + 'px'
    });
  }
});
</script>
