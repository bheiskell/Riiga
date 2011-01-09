/**
 * Extend selectmenu as select to add required functionality not supported by
 * the base selectmenu. Such features include minor bug fixes / tweaks, Adding
 * a slide out menu with callbacks, and adding support for individual options
 * to be disabled.
 */
$.widget('ui.selectsubmenu', $.ui.selectmenu, {
  options: {
    style: 'dropdown',
    menuWidth: 0,
    submenuPosition: 'right',
    submenuWidth: 0,
    submenuHeight: 0,
    preopen: false, // callback
    fillSubmenu: false // callback
  },

  _init: function() {
    var self = this;
    $.ui.selectmenu.prototype._init.call(this);

    // by default selectmenu ignores padding width which we need included. also
    // need to half the space for the submenu to use.
    if (!this.options.menuWidth) {
      this.list.width(this.newelement.innerWidth()/2);
    }

    this.element.change(function() { self._updateDisabledFields(); });

    $('li', this.list).mouseover(function(event) { self._hover(event) });

    this._updateDisabledFields();
  },

  /* Add submenu slide out */
  open: function(event) {
    $(document).trigger('mousedown'); // close other open selectmenus

    if (this.options.preopen) { this.options.preopen(); }

    $.ui.selectmenu.prototype.open.call(this);

    var submenuCss = {
      height: (this.options.submenuHeight || this.list.height()),
      width:  (this.options.submenuWidth  || this.list.width()),
      top:    this.list.offset().top
    }

    if ('right' == this.options.submenuPosition) {
      submenuCss.left = this.list.offset().left + this.list.innerWidth();
    } else {
      submenuCss.left = this.list.offset().left - submenuCss.width;
    }

    var slideFromLeft = ('right' == this.options.submenuPosition);

    var conf = ('right' == this.options.submenuPosition)
    this.submenu = $('<div class="ui-selectsubmenu-submenu"></div>')
      .css(submenuCss)
      .mousedown(function(event) { event.stopPropagation(); })
      .insertBefore(this.list)
      .hide()
      .effect('slide', { direction: (slideFromLeft) ? 'left' : 'right' });
  },

  /* Provide a hover callback for obtaining submenu content */
  _hover: function(event) {
    var index = $(event.currentTarget).data('index');
    if (index) {
      var option = $('option', this.element).eq(index);

      if (this.options.fillSubmenu) {
        var contents = this.options.fillSubmenu(option, this.submenu);
      }

      event.stopPropagation();
    }
  },

  /* Add support for disabled options */
  _updateDisabledFields: function() {
    var options = $('option', this.element);

    $('li', this.list).each(function() {
      var disabled = options.eq($(this).data('index')).attr('disabled');

      if (disabled) {
        $(this).addClass('ui-state-disabled');
      } else {
        $(this).removeClass('ui-state-disabled');
      }
    });

    this._refreshValue();
  },

  value: function(index) {
    if (arguments.length) this.disabledOptionSelected = 
      $('option', this.element).eq(index).attr('disabled');

    return (!this.disabledOptionSelected && arguments.length)
      ? $.ui.selectmenu.prototype.value.call(this, index)
      : $.ui.selectmenu.prototype.value.call(this);
  },

  close: function(event, retainFocus) {
    if (retainFocus && this.disabledOptionSelected) return;

    if (this.submenu) this.submenu.remove();

    return $.ui.selectmenu.prototype.close.call(this, event, retainFocus);
  },

  /* Empty options do not render correctly. Fixing this bug here. */
  _formatText: function(text){
    if ('' == text) text = '&nbsp;';

    return $.ui.selectmenu.prototype._formatText.call(this, text);
  }
});
