/**
 * I wrote this instead of using an off the shelf plugin, because I needed
 * captioning and the capability of limiting the upper bound of the stars.
 * Users need to know the rank they're selecting and aren't able to select
 * character ranks above their own member ranks.
 *
 * This is purely cosmetic, meaning it uses no ajax and completely leverages the
 * radio input buttons for value storage.
 *
 * Usage:
 *  <select name="stars">
 *    <select value='1'>Caption 1</select>
 *    {...}
 *    <select value='10'>Caption 10</select>
 *  </div>
 *  <script> $('.stars').stars({valueLimit: 5;}) </script>
 */
(function($) {

  $.fn.extend({
    star: function(opts) {
      var opts = $.extend({
        disabledMessage: ' (disabled)',
        indexOffset: -1, // offset to add to the value to obtain zero index
        valueLimit:  -1, // restrict max value selectable
        classes: {
          container:  'star required',
          unselected: 'default',
          selected:   'selected',
          hover:      'hover',
          disabled:   'disabled'
        }
      }, opts);

      return this.each(function() {
        var select         = $(this);
        var options        = select.children();
        var starContainer  = $('<div></div>')
        var stars          = null;

        // when no upper limit is set, set it to the last value
        if (-1 == opts.valueLimit) {
          opts.valueLimit = options.filter(':last').val();
        }

        var highlight = function(highlightClass, anchor) {

          // when anchor isn't specified highlight the currently selected star
          var star = (anchor) ? anchor
            : stars.eq(parseInt(select.val(),10) + opts.indexOffset);

          if (star.data('enabled')) {
            star.siblings('span').text(star.data('text'));

            star.prevAll('a').andSelf().not('.'+opts.classes.disabled)
              .removeClass()
              .addClass(highlightClass);

            star.nextAll('a').not('.'+opts.classes.disabled)
              .removeClass()
              .addClass(opts.classes.unselected);

          // provide a hint as to why the disabled stars are disabled
          } else {
            star.siblings('span').text(
              star.data('text') + opts.disabledMessage
            );
          }
        }

        options.each(function() {
          var option  = $(this);
          var anchor = $('<a>&nbsp;</a>').attr('href', '#');

          anchor.click(
            function() {
              if (anchor.data('enabled')) {
                select.val(option.val());
                highlight(opts.classes.selected);
              }
              return false; // don't trigger page change
            }
          )
          .mouseenter(function() { highlight(opts.classes.hover, $(this)); })
          .mouseleave(function() { highlight(opts.classes.selected); })
          .attr('hideFocus', true) // ie focus border hack
          .data('enabled', (parseInt(option.val(), 10) <= opts.valueLimit))
          .data('text', option.text())
          ;

          // this class shouldn't be removed once it's added
          if (!anchor.data('enabled')) {
            anchor.addClass(opts.classes.disabled);
          }

          starContainer.append(anchor);
        })
        stars = starContainer.children('a');

        // in a hopefully swift move, replace the inputs with the stars
        starContainer
          .addClass(opts.classes.container)
          .append($('<span>&nbsp;</span>'))
        highlight(opts.classes.selected);
        select.hide().after(starContainer);

      });
    }
  });
})(jQuery);
