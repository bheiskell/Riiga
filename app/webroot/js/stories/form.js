$().ready(function() {
  var container = $('select#StoryLocationId').parent();
  var label = $('label', container);
  var sample = $('input[type=text]:first');
  var select = $('select', container);
  var information = $('<div/>');

  var div = $('<div/>')
    .css({
      border: '1px solid #D3D3D3',
      paddingLeft: label.innerWidth(),
      height: 12 * 2 + 'em',
      margin: 0,
      width: sample.width() + sample.css('paddingRight').replace(/px/, '') * 2,
      overflow: 'hidden'
    })
    .append(select)
    .append(information)
    .appendTo(container)
    ;
  var locations = $('#LocationInformation');
  $(select).tree_drilldown({
    click: function() {},
    hover: function() {
      var map;
      if (0 == information.children().length) {
        map = $('img', locations).clone().location_map({
          width:  400,
          height: 200
        }).parent();
      } else {
        map = information.children(':first').detach();
      }

      information.children().remove().end().append(map);
      $('img', information).location_map('region', 0, 0, 100, 100, 1000);

      var id = $(this).data('location_id');
      if (!id) return;

      var content =$('.LocationId_' + id, locations).clone();

      $('dl', content).hide();

      information.append(content).clearQueue().animate({
        height: content.outerHeight() + map.outerHeight(),
        width:  content.outerWidth()
      });

      $('img', information).location_map(
        'region',
        parseInt($('dt:contains("Left")', content).next().text()),
        parseInt($('dt:contains("Top")', content).next().text()),
        parseInt($('dt:contains("Width")', content).next().text()),
        parseInt($('dt:contains("Height")', content).next().text()),
        1000
      );
    },
    name: 'Riiga'
  });

  $('span:first', select.next()).css({
    height: label.height(),
    lineHeight: label.css('lineHeight')
  });

  div.children().css({
    float: 'left',
    width: '50%'
  });
});
