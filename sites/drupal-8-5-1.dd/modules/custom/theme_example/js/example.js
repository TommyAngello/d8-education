(function ($) {
  Drupal.behaviors.themeExample = {
    attach: function (context, settings) {
      // jQuery once ensures that code does not run after an AJAX or other
      // function that calls Drupal.attachBehaviors().
      $('body').once('themeExample').each(function () {
        // We have console.log() here to make it easy to see that this code is
        // functioning.  You should never use console.log() on production code!
        if (typeof console.log === 'function') {
          console.log('My Setting: ' + settings.sampleLibrary.mySetting);
        }
      });
      if (typeof console.log === 'function') {
        console.log('This will run every time Drupal.attachBehaviors is run.');
      }
      $('body').once('themeExampleModifyDOM').each(function () {
        // Add an element to the body.
        $('body').append('Hello World');
        // Tell Drupal that we modified the DOM.
        Drupal.attachBehaviors();
      });
    }
  };
})(jQuery);