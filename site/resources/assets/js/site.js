
(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Hamburger menu activation
    $('.navbar-burger').bind('click', function(event) {
        $('#' + $(this).data('target')).toggleClass('is-active');
    });

    $('.notification > button.delete').bind('click', function(event) {
        $(this).parent().addClass('is-hidden');
    });

})(jQuery); // End of use strict