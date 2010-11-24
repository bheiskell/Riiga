/**
 * Quickly written widget that converts a checkbox to two buttons.
 */
$.widget('ui.checkbuttons', {
  options: {
    messageOff: 'Off',
    messageOn:  'On'
  },
  _init: function() {
    var self = this, id = this.element.attr('id');

    var inputOff = $('<input type="radio" value="0" />');
    var inputOn  = $('<input type="radio" value="1" />');

    var labelOff = $('<label></label>').text(this.options.messageOff);
    var labelOn  = $('<label></label>').text(this.options.messageOn);

    inputOff.attr('name', id + 'Radio').attr('id', id + 'Off');
    inputOn .attr('name', id + 'Radio').attr('id', id + 'On');

    inputOff.attr('checked', !this.element.attr('checked'));
    inputOn .attr('checked',  this.element.attr('checked'));

    inputOff.change(function() { self.element.attr('checked', false); })
    inputOn .change(function() { self.element.attr('checked', true); })

    labelOff.attr('for', inputOff.attr('id'));
    labelOn .attr('for', inputOn .attr('id'));

    this.radios = $('<div></div>')
      .append(inputOff)
      .append(labelOff)
      .append(inputOn)
      .append(labelOn)
      .buttonset()
      .insertAfter(this.element.parent());

    this.element.parent().hide();
  },
  destroy: function() {
    this.radios.buttonset('destroy');
    this.radios.remove();
    this.element.parent().show();
  }
});
