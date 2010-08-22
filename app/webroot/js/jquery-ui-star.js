/**
 * Convert a select box to stars. If the option is disabled, the star is 
 * disabled as well. There are callbacks for hovers and selects.
 */
(function($) {

  $.widget("ui.star", {
    _init: function() {
      var self = this, o = this.options;

      this.starContainer  = $(
        '<div class="'+ this.widgetBaseClass +' ui-widget"></div>'
      );

      $('option', this.element).each(function() {
        var anchor = $('<a href="#">&nbsp;</a>')
          .data({
            text:     $(this).text(),
            value:    $(this).attr('value'),
            disabled: $(this).attr('disabled'),
          })
          .click(    function(event) { self._select(this); return false; })
          .mouseover(function(event) { self._highlight(this); })
          .mouseout( function(event) { self._refresh(); });

        anchor.addClass(
          anchor.data('disabled') ? 'ui-state-disabled' : 'ui-state-default'
        );

        self.starContainer.append(anchor);
      });

      this._update();

      this.element.hide().change(function () { self._update(); });

      this.starContainer.insertAfter(this.element);
    },
    destroy: function() {
      this.element.unbind('change').show();
      this.starContainer.remove();
      $.widget.prototype.destroy.call(this);
    },

    _update: function() {
      this.selected = $('a', this.starContainer).eq(
        $('option:selected', this.element).index() || 0
      );
      this._refresh();
    },

    _select: function(star) {
      this.element.val($(star).data('value'));
      this.selected = $(star);
      this._refresh();
      this._trigger('select', 0, star);
    },
    _highlight: function(star) {
      var class = $(star).data('disabled')
                ? 'ui-state-highlight'
                : 'ui-state-hover';
      this._refresh(star, class);
      this._trigger('highlight', 0, star);
    },
    _refresh: function(star, class) {
      star  = star  || this.selected;
      class = class || 'ui-state-highlight';

      $(star).prevAll().andSelf().not('.ui-state-disabled')
        .removeClass()
        .addClass(class);
      $(star).nextAll().not('.ui-state-disabled')
        .removeClass()
        .addClass('ui-state-default');
    },
  });

  $.extend($.ui.star, { defaults: { } });
})(jQuery);
