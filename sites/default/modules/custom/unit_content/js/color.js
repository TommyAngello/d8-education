/**
 * @file.
 * Contains the definition of the behaviour unitEntityColors.
 */

(function ($, Drupal, drupalSettings) {

  /**
   * Attaches the JS behavior to id.
   *
   * @see console.log(drupalSettings.unit_content.color);
   */
  Drupal.behaviors.unitEntityColors = {
    attach: function (context, settings) {

      var colors = drupalSettings.unit_content.color;
      $.each(colors, function( key, value ) {
        $( '#' + key ).css( 'color', value );
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
