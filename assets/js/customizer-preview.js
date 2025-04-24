jQuery(document).ready(function($) {
    // Hero section preview
    wp.customize('amt_hero_title', function(value) {
        value.bind(function(newval) {
            $('.hero-content h1').text(newval);
        });
    });
    
    wp.customize('amt_hero_text', function(value) {
        value.bind(function(newval) {
            $('.hero-content p').text(newval);
        });
    });
    
    wp.customize('amt_hero_button_text', function(value) {
        value.bind(function(newval) {
            $('.hero-content .btn').text(newval);
        });
    });
    
    wp.customize('amt_hero_background', function(value) {
        value.bind(function(newval) {
            $('.hero-section').css('background-image', 'url(' + newval + ')');
        });
    });
    
    // Footer copyright preview
    wp.customize('amt_copyright_text', function(value) {
        value.bind(function(newval) {
            $('footer .text-center.mt-3').text('© ' + new Date().getFullYear() + ' ' + newval);
        });
    });
});