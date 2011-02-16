$().ready(function() {
  var content = $('div.users.messages');

  var selectAll = $('<input/>')
    .attr('type',  'button')
    .attr('value', 'Select All')
    .button()
    .toggle(function() {
      $('input[type=checkbox]', content).attr('checked', true);
      $(this).val('Select None');

    }, function() {
      $('input[type=checkbox]', content).attr('checked', false);
      $(this).val('Select All');
    });

  $('div.submit', content).prepend(selectAll);
})
