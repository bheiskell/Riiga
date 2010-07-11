/**
 * I wrote this instead of using an off the shelf plugin, because I needed
 * captioning and the capability of limiting the upper bound of the stars.
 * Users need to know the rank they're selecting and aren't able to select
 * character ranks above their own member ranks.
 *
 * Convert a set of numerically sequential radio buttons to stars. Also offer
 * the ability to set the upper limit through the valueLimit option.  Call on a
 * div with individual labels wrapping each radio button. The label text will
 * be used as a caption for the stars.
 *
 * This is purely cosmetic, meaning it uses no ajax and completely leverages the
 * radio input buttons for value storage.
 *
 * Usage:
 *  <div class="stars">
 *    <label><input type='radio' value='1'/>Caption 1</label>
 *    {...}
 *    <label><input type='radio' value='10'/>Caption 10</label>
 *  </div>
 *  <script> $('.stars').stars({valueLimit: 5;}) </script>
 */
(function($) {

  $.fn.extend({
    star: function(opts) {
      var opts = $.extend({
        disabledMessage: ' (disabled)',
        label:           'Rank',
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
        var radioContainer = $(this);
        var radios         = $(':radio', radioContainer);
        var starContainer  = $('<div></div>')
        var stars          = null;

        // when no upper limit is set, set it to the last value
        if (-1 == opts.valueLimit) {
          opts.valueLimit = radios.filter(':last').val();
        }

        // to avoid error checking later, ensure a radio button is selected
        if (!radios.filter(':checked').length) {
          radios.eq(0).attr('checked', 'checked');
        }

        var value = radios.filter(':checked').val();

        var highlight = function(highlightClass, anchor) {

          // when anchor isn't specified highlight the currently selected star
          var star = (anchor) ? anchor
                              : stars.eq(parseInt(value,10) + opts.indexOffset);

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

        starContainer.append($('<label>' + opts.label + '</label>'));

        radios.each(function() {
          var radio  = $(this);
          var anchor = $('<a>&nbsp;</a>').attr('href', '#');

          anchor.click(
            function() {
              if (anchor.data('enabled')) {

                value = radio.val();
                radios.removeAttr('checked');
                radio.attr('checked', 'checked');

                highlight(opts.classes.selected);
              }
              return false; // don't trigger page change
            }
          )
          .mouseenter(function() { highlight(opts.classes.hover, $(this)); })
          .mouseleave(function() { highlight(opts.classes.selected); })
          .attr('hideFocus', true) // ie focus border hack
          .data('enabled', (parseInt(radio.val(), 10) <= opts.valueLimit))
          .data('text', $('label[for=' + radio.attr('id') +']').text())
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
        radioContainer.hide().after(starContainer);

      });
    }
  });
})(jQuery);
