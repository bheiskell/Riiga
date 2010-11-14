$(document).ready(function() {
  $('img[src$="riiga.png"]').location_map({
    width:  600,
    height: 436
  })
  .location_selector({
    callbackPosition: function(x, y, width, height) {
      $('#LocationRegionLeft')  .val(x);
      $('#LocationRegionTop')   .val(y);
      $('#LocationRegionWidth') .val(width);
      $('#LocationRegionHeight').val(height);
    }
  });
});
