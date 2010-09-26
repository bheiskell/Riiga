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
  aspectRatio: {
    x: 1,
    y: 1
  },
  _init: function() {
    var self = this, o = this.options;

    this.element.wrap('<div class="ui-location"/>');
    this.container = this.element.parent();

    this.element.load(function() {
      o.height = (o.height) ? o.height : this.height;
      o.width =  (o.width)  ? o.width  : this.width;

      var aspectX = 1.0 * o.width  / self.element[0].width;
      var aspectY = 1.0 * o.height / self.element[0].height;
      self.aspectRatio.x = (1 < aspectY/aspectX) ? 1 : aspectY/aspectX;
      self.aspectRatio.y = (1 < aspectX/aspectY) ? 1 : aspectX/aspectY;

      self.container.css({
        height: o.height + 'px',
        width:  o.width  + 'px'
      });

      self.position(0, 0, 100, 100, 0);
    });
  },
  destroy: function() {
    this.element.removeClass('ui-location-container');
  },
  // reposition the map using percents
  position: function(x, y, width, height, duration) {
    var zoomX = 100.0 / width;
    var zoomY = 100.0 / height;
    var zoom = (zoomX < zoomY) ? zoomX : zoomY;


    //alert((x / y) / (this.apsectRatio.x / this.aspectRatio.y));

    this.element.animate({
        left:
         - (x * this.aspectRatio.x * zoom * this.options.width  / 100.0) + 'px',
        top:
         - (y * this.aspectRatio.y * zoom * this.options.height / 100.0) + 'px',
        height: (zoom * this.aspectRatio.y * this.options.height) + 'px',
        width:  (zoom * this.aspectRatio.x * this.options.width)  + 'px'
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
