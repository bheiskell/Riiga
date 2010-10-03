$(document).ready(function() {
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
});
