<?php
/**
 * AMT-Spice functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define theme version
define('AMT_SPICE_VERSION', '1.0.0');

// Theme setup
function amt_spice_setup() {
    load_theme_textdomain('amt-spice', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo');
    
    // Register all menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'amt-spice'),
        'footer-1' => __('Footer Column 1', 'amt-spice'),
        'footer-2' => __('Footer Column 2', 'amt-spice'),
        'footer-3' => __('Footer Column 3', 'amt-spice'),
        'sidebar-menu' => __('Sidebar Menu', 'amt-spice')
    ));
}
add_action('after_setup_theme', 'amt_spice_setup');

// Enqueue scripts and styles
function amt_spice_scripts() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
    
    // Theme styles
    wp_enqueue_style('amt-spice-style', get_stylesheet_uri());
    wp_enqueue_style('amt-spice-custom', 
        get_template_directory_uri() . '/assets/css/styles.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-timeline', 
        get_template_directory_uri() . '/assets/css/timeline.css',
        array(),
        AMT_SPICE_VERSION
    );
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.3',
        true
    );
    
    // Chart.js
    wp_enqueue_script('chart-js', 
        'https://cdn.jsdelivr.net/npm/chart.js',
        array(),
        '4.4.0',
        true
    );
    
    // Counter JS
    wp_enqueue_script('counter-js', 
        get_template_directory_uri() . '/assets/js/counter.js',
        array(),
        AMT_SPICE_VERSION,
        true
    );
    
    // Customizer preview JS
    if (is_customize_preview()) {
        wp_enqueue_script('amt-spice-customizer-preview', 
            get_template_directory_uri() . '/assets/js/customizer-preview.js',
            array('jquery', 'customize-preview'),
            AMT_SPICE_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'amt_spice_scripts');

// Include required files
//require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php'; chaned to:
// Register Nav Walker class
if (!class_exists('WP_Bootstrap_Navwalker')) {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
require_once get_template_directory() . '/inc/customizer.php'; // Customizer now lives here
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';

// Add custom classes to sidebar menu links
function add_menu_link_classes($atts, $item, $args) {
    if ($args->theme_location === 'sidebar-menu') {
        $atts['class'] = isset($atts['class']) 
            ? $atts['class'] . ' fw-bold text-primary' 
            : 'fw-bold text-primary';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_classes', 10, 3);

//theme customizer
// functions.php


// JSON Sanitization callback
function amt_sanitize_json($input) {
    $decoded = json_decode($input, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return $input;
    }
    return '';
}