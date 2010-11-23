$().ready(function() {
  $('select#StoryLocationId').tree_drilldown({
    click: function() {},
    hover: function() {}
  }).prevAll('label').hide();
});
