$(document).ready(function() {
  $('img[src$="riiga.jpg"]').location_map({
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

  /**
   * Apply the location tag formatter
   */
  $('#LocationDescription').attr('rows', 3);
  $('#LocationTagLocationTag').custSelectBox({ selectwidth: 250 });
});
