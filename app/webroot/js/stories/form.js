$().ready(function() {
  var container = $('select#StoryLocationId').parent();
  var label = $('label', container);
  var select = $('select', container);
  var information = $('<div class="ui-location-menu-info"/>');
  var map = $('<div/>');

  var menu = $('<div class="ui-location-menu"/>')
    .append(map)
    .append(select)
    .append(information)
    .appendTo(container);

  var locations = $('#LocationInformation');

  $(select).treeDrilldown({
    name: 'Riiga',
    mouseover: function() {
      var id = $(this).data('location_id');
      locations.locationInfo('select', id);
    },
    mouseout: function() {
      var id = select.val();
      locations.locationInfo('select', id);
    },
  });

  $('span:first', select.next()).css({
    height: label.height(),
    lineHeight: label.css('lineHeight')
  });

  locations.appendTo(information);
  locations.locationInfo({
    height: menu.height()
  });

  $('img', locations).load(function() {
    // Semi-hack: load the location info widget and then move the map.
    map.append($('div.ui-location-map', locations));
  });

  $('#StoryIsInviteOnly').checkbuttons({
    messageOn: 'Invite only',
    messageOff: 'Open to all'
  });
});
