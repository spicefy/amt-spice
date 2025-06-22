(function($) {
    wp.customize('text_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--text-color', newval);
        });
    });
    wp.customize('menu_link_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--menu-color', newval);
        });
    });
    wp.customize('menu_link_hover_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--menu-hover-color', newval);
        });
    });
    wp.customize('primary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--primary-color', newval);
        });
    });
})(jQuery);
