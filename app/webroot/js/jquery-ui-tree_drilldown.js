(function($) {
  $.widget("ui.tree_drilldown", {
    options: {
      name: 'Riiga',
      click: null,
      hover: null
    },
    _init: function() {
      var opts = $('option', this.element);

      if (0 == opts.length) { return this.destroy(); }

      // Need to skip the first entry if it's blank
      if (!opts.first().val()) { opts = opts.not(':first'); }

      this.menu     = this._generate(opts);
      this.location = this.menu.children('span');

      this._initialize(this.menu);
      this._select(this.menu);
      this.element.hide();
      this.element.after(this.menu);
    },
    destroy: function() {
      this.menu.remove();
    },
    _initialize: function(menu) {
      // When first loading, we only want to show the first tier of options
      $('ul ul', menu).hide();

      // Due to elements sliding upwards, the spans above need to have a larger
      // z-index that the spans below. Use the number of parent uls to calculate
      // depth.
      $('span', menu)
        .addClass('ui-state-default')
        .each(function() {
          var depth = $(this).parents('ul').length;
          $(this).css({ zIndex: (10 - depth) });
        });
    },
    _select: function(menu) {
      var location = menu.children('span');
      var children = menu.children('ul');

      $('ul, li', menu).animate({ top: 0 }); // reset previous animations
      $('ul', children).slideUp();           // close all grandchildren
      children.slideDown();                  // open children

      this.location.removeClass('ui-state-active');
      this.location.siblings().removeClass('ui-widget-content');

      location.addClass('ui-state-active');
      location.siblings().addClass('ui-widget-content');

      this.location = location;

      this.element.val(location.data('location_id'));
    },
    _click: function(menu) {
      this._select(menu);

      menu.parent('ul').animate({ top: -menu.position().top });
      menu.nextAll('li').animate({ top: '500px' });

      if (this.options.click) { $.proxy(this.options.click, menu)(); }
    },
    _mouseover: function(location) {
      $(location).addClass('ui-state-hover');

      if (this.options.hover) { $.proxy(this.options.hover, menu)(); }
    },
    _mouseout: function(location) {
      $(location).removeClass('ui-state-hover');
    },
    _generate: function(opts) {
      var self = this;

      var menu = $('<div/>')
        .addClass('ui-tree-drilldown')
        .addClass('ui-widget')
        .addClass('ui-helper-reset')
      var node = $('<ul/>');
      var span = $('<span/>')
        .text(this.options.name)
        .click(function()     { self._select(self.menu) })
        .mouseover(function() { self._mouseover(this); })
        .mouseout (function() { self._mouseout(this); });

      menu.append(span).append(node);

      var previous_depth = 0;
      for (var i = 0; i < opts.length; i++) {
        var tiers    = opts.eq(i).text().split('|');
        var location = tiers.pop().trim();
        var depth    = tiers.length;
        var delta    = depth - previous_depth;

        // burrow and resurface
        if    (1 == delta)   { node = node.children(':last').children('ul'); }
        while (0 >  delta++) { node = node.parent().parent(); }

        var li   = $('<li/>');
        var ul   = $('<ul/>');
        var span = $('<span/>')
          .text(location)
          .data('location_id', opts.eq(i).val())
          .click    (function() { self._click($(this).parent()); })
          .mouseover(function() { self._mouseover(this); })
          .mouseout (function() { self._mouseout(this); });

        li.append(span).append(ul).appendTo(node);

        previous_depth = depth;
      };
      return menu;
    }
  });
})(jQuery);
