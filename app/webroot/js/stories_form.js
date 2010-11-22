$().ready(function() {
  $('select#StoryLocation').tree_drilldown({
    click: function() {},
    hover: function() {}
  }).prevAll('label').hide();
});
