<?php
/**
 * AMT-Spice Customizer functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function amt_spice_customize_register($wp_customize) {
    // Add Theme Options Panel
    $wp_customize->add_panel('amt_theme_options', array(
        'title' => __('AMT-Spice Theme Options', 'amt-spice'),
        'priority' => 1,
    ));
    
    // Header Section
    $wp_customize->add_section('amt_header', array(
        'title' => __('Header Settings', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 10,
    ));
    
    // Logo Upload
    $wp_customize->add_setting('amt_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_logo', array(
        'label' => __('Upload Logo', 'amt-spice'),
        'section' => 'amt_header',
        'settings' => 'amt_logo',
    )));
    
    // Donate Button
    $wp_customize->add_setting('amt_donate_text', array(
        'default' => __('Donate', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_donate_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('amt_donate_text_control', array(
        'label' => __('Donate Button Text', 'amt-spice'),
        'section' => 'amt_header',
        'settings' => 'amt_donate_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_donate_link_control', array(
        'label' => __('Donate Button Link', 'amt-spice'),
        'section' => 'amt_header',
        'settings' => 'amt_donate_link',
        'type' => 'url',
    ));
    
    // Hero Section
    $wp_customize->add_section('amt_hero', array(
        'title' => __('Hero Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 20,
    ));
    
    $wp_customize->add_setting('amt_hero_title', array(
        'default' => __('Book us today', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_hero_text', array(
        'default' => __('Get blush-free facts and stories about love, sex, and relationships.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_textarea_field', // Changed to textarea field
    ));
    
    $wp_customize->add_setting('amt_hero_button_text', array(
        'default' => __('Get Started', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_hero_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_hero_background', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('amt_hero_title_control', array(
        'label' => __('Hero Title', 'amt-spice'),
        'section' => 'amt_hero',
        'settings' => 'amt_hero_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_hero_text_control', array(
        'label' => __('Hero Text', 'amt-spice'),
        'section' => 'amt_hero',
        'settings' => 'amt_hero_text',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('amt_hero_button_text_control', array(
        'label' => __('Button Text', 'amt-spice'),
        'section' => 'amt_hero',
        'settings' => 'amt_hero_button_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_hero_button_link_control', array(
        'label' => __('Button Link', 'amt-spice'),
        'section' => 'amt_hero',
        'settings' => 'amt_hero_button_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_hero_background_control', array(
        'label' => __('Hero Background Image', 'amt-spice'),
        'section' => 'amt_hero',
        'settings' => 'amt_hero_background',
    )));
    
    // Intro Section
    $wp_customize->add_section('amt_intro', array(
        'title' => __('Intro Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('amt_intro_title', array(
        'default' => __('Blush-free facts and stories about love, sex, and relationships.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_intro_text', array(
        'default' => __('Learn more about Blush-free facts and stories about love, sex, and relationships', 'amt-spice'),
        'sanitize_callback' => 'sanitize_textarea_field', // Changed to textarea field
    ));
    
    $wp_customize->add_setting('amt_intro_button_text', array(
        'default' => __('Learn More', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_intro_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_intro_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('amt_intro_title_control', array(
        'label' => __('Intro Title', 'amt-spice'),
        'section' => 'amt_intro',
        'settings' => 'amt_intro_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_intro_text_control', array(
        'label' => __('Intro Text', 'amt-spice'),
        'section' => 'amt_intro',
        'settings' => 'amt_intro_text',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('amt_intro_button_text_control', array(
        'label' => __('Button Text', 'amt-spice'),
        'section' => 'amt_intro',
        'settings' => 'amt_intro_button_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_intro_button_link_control', array(
        'label' => __('Button Link', 'amt-spice'),
        'section' => 'amt_intro',
        'settings' => 'amt_intro_button_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_intro_image_control', array(
        'label' => __('Intro Image', 'amt-spice'),
        'section' => 'amt_intro',
        'settings' => 'amt_intro_image',
    )));
    
    // Services Section
    $wp_customize->add_section('amt_services', array(
        'title' => __('Services Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('amt_services_title', array(
        'default' => __('Our Services', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('amt_services_title_control', array(
        'label' => __('Services Section Title', 'amt-spice'),
        'section' => 'amt_services',
        'settings' => 'amt_services_title',
        'type' => 'text',
    ));
    
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('amt_service_title_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_setting('amt_service_text_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_textarea_field', // Changed to textarea field
        ));
        
        $wp_customize->add_setting('amt_service_link_' . $i, array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('amt_service_title_' . $i . '_control', array(
            'label' => sprintf(__('Service %d Title', 'amt-spice'), $i),
            'section' => 'amt_services',
            'settings' => 'amt_service_title_' . $i,
            'type' => 'text',
        ));
        
        $wp_customize->add_control('amt_service_text_' . $i . '_control', array(
            'label' => sprintf(__('Service %d Text', 'amt-spice'), $i),
            'section' => 'amt_services',
            'settings' => 'amt_service_text_' . $i,
            'type' => 'textarea',
        ));
        
        $wp_customize->add_control('amt_service_link_' . $i . '_control', array(
            'label' => sprintf(__('Service %d Link', 'amt-spice'), $i),
            'section' => 'amt_services',
            'settings' => 'amt_service_link_' . $i,
            'type' => 'url',
        ));
    }
    
    
    
    // Our Impact
    $wp_customize->add_section('amt_chat_support', array(
        'title' => __('Our Impact Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 60,
    ));
    
    $wp_customize->add_setting('amt_chat_title', array(
        'default' => __('Our Impact', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_chat_text', array(
        'default' => __('Our trained health educators and chat bot are available in real time.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_setting('amt_chat_button_text', array(
        'default' => __('Chat Now', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_chat_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_chat_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('amt_chat_title_control', array(
        'label' => __('Chat Section Title', 'amt-spice'),
        'section' => 'amt_chat_support',
        'settings' => 'amt_chat_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_chat_text_control', array(
        'label' => __('Chat Section Text', 'amt-spice'),
        'section' => 'amt_chat_support',
        'settings' => 'amt_chat_text',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('amt_chat_button_text_control', array(
        'label' => __('Chat Button Text', 'amt-spice'),
        'section' => 'amt_chat_support',
        'settings' => 'amt_chat_button_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_chat_button_link_control', array(
        'label' => __('Chat Button Link', 'amt-spice'),
        'section' => 'amt_chat_support',
        'settings' => 'amt_chat_button_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_chat_image_control', array(
        'label' => __('Chat Section Image', 'amt-spice'),
        'section' => 'amt_chat_support',
        'settings' => 'amt_chat_image',
    )));
    
    // Social Media Counters
    $wp_customize->add_section('amt_social_counters', array(
        'title' => __('Social Media Counters', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 70,
    ));
    
    $social_platforms = array(
        'facebook' => array(
            'default' => 15000,
            'label'   => __('Facebook Followers', 'amt-spice')
        ),
        'instagram' => array(
            'default' => 9500,
            'label'   => __('Instagram Followers', 'amt-spice')
        ),
        'tiktok' => array(
            'default' => 12000,
            'label'   => __('TikTok Followers', 'amt-spice')
        ),
        'website' => array(
            'default' => 500000,
            'label'   => __('Monthly Website Visitors', 'amt-spice')
        )
    );
    
    foreach ($social_platforms as $platform => $data) {
        $wp_customize->add_setting("amt_counter_{$platform}", array(
            'default'           => $data['default'],
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control("amt_counter_{$platform}_control", array(
            'label'    => sprintf(__('%s Count', 'amt-spice'), ucfirst($platform)),
            'section'  => 'amt_social_counters',
            'settings' => "amt_counter_{$platform}",
            'type'     => 'number',
        ));
        
        $wp_customize->add_setting("amt_counter_{$platform}_label", array(
            'default'           => $data['label'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("amt_counter_{$platform}_label_control", array(
            'label'    => sprintf(__('%s Label', 'amt-spice'), ucfirst($platform)),
            'section'  => 'amt_social_counters',
            'settings' => "amt_counter_{$platform}_label",
            'type'     => 'text',
        ));
    }
    
    // Testimonials Section
    $wp_customize->add_section('amt_testimonials', array(
        'title' => __('Testimonials Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 50,
    ));
    
    $wp_customize->add_setting('amt_testimonials_title', array(
        'default' => __('Testimonials Get Blush-free facts and stories about love, sex, and relationships', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_testimonials_text', array(
        'default' => __('Visit our website lovemattersafrica.com today.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_textarea_field', // Changed to textarea field
    ));
    
    $wp_customize->add_setting('amt_testimonials_button_text', array(
        'default' => __('Learn More', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_testimonials_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('amt_testimonials_title_control', array(
        'label' => __('Testimonials Title', 'amt-spice'),
        'section' => 'amt_testimonials',
        'settings' => 'amt_testimonials_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_testimonials_text_control', array(
        'label' => __('Testimonials Text', 'amt-spice'),
        'section' => 'amt_testimonials',
        'settings' => 'amt_testimonials_text',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('amt_testimonials_button_text_control', array(
        'label' => __('Button Text', 'amt-spice'),
        'section' => 'amt_testimonials',
        'settings' => 'amt_testimonials_button_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_testimonials_button_link_control', array(
        'label' => __('Button Link', 'amt-spice'),
        'section' => 'amt_testimonials',
        'settings' => 'amt_testimonials_button_link',
        'type' => 'url',
    ));
    // Footer Section
    $wp_customize->add_section('amt_footer', array(
        'title' => __('Footer Settings 24', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 100,
    ));
    
    $wp_customize->add_setting('amt_footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_footer_description', array(
        'default' => __('Love Matters Africa provides easy-to-access information and news on sexuality and sexual health for the country\'s young people.', 'amt-spice'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_setting('amt_footer_col1_title', array(
        'default' => __('Get Involved', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_footer_col2_title', array(
        'default' => __('Resources', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_footer_col3_title', array(
        'default' => __('About This Site', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    // Social Media Links
    $wp_customize->add_setting('amt_social_facebook', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_social_twitter', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_social_instagram', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_social_youtube', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    // Footer Links
    $wp_customize->add_setting('amt_privacy_text', array(
        'default' => __('Privacy Notice', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_privacy_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_terms_text', array(
        'default' => __('Terms of Use', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_terms_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_contact_text', array(
        'default' => __('Contact Us', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_contact_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_setting('amt_copyright_text', array(
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    // Add controls for all settings
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_footer_logo_control', array(
        'label' => __('Footer Logo', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_logo',
    )));
    
    $wp_customize->add_control('amt_footer_description_control', array(
        'label' => __('Footer Description', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_description',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('amt_footer_col1_title_control', array(
        'label' => __('Footer Column 1 Title', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_col1_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_footer_col2_title_control', array(
        'label' => __('Footer Column 2 Title', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_col2_title',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_footer_col3_title_control', array(
        'label' => __('Footer Column 3 Title', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_col3_title',
        'type' => 'text',
    ));
    
    // Social Media Controls
    $wp_customize->add_control('amt_social_facebook_control', array(
        'label' => __('Facebook URL', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_social_facebook',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_social_twitter_control', array(
        'label' => __('Twitter URL', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_social_twitter',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_social_instagram_control', array(
        'label' => __('Instagram URL', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_social_instagram',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_social_youtube_control', array(
        'label' => __('YouTube URL', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_social_youtube',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_social_linkedin_control', array(
        'label' => __('LinkedIn URL', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_social_linkedin',
        'type' => 'url',
    ));
    
    // Footer Links Controls
    $wp_customize->add_control('amt_privacy_text_control', array(
        'label' => __('Privacy Text', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_privacy_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_privacy_link_control', array(
        'label' => __('Privacy Link', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_privacy_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_terms_text_control', array(
        'label' => __('Terms Text', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_terms_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_terms_link_control', array(
        'label' => __('Terms Link', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_terms_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_contact_text_control', array(
        'label' => __('Contact Text', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_contact_text',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('amt_contact_link_control', array(
        'label' => __('Contact Link', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_contact_link',
        'type' => 'url',
    ));
    
    $wp_customize->add_control('amt_copyright_text_control', array(
        'label' => __('Copyright Text', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_copyright_text',
        'type' => 'text',
    ));
}
add_action('customize_register', 'amt_spice_customize_register');
// In inc/customizer.php
function amt_customize_register($wp_customize) {
    // Legal Links Section
    $wp_customize->add_section('amt_legal_links', [
        'title' => __('Legal Links', 'amt-spice'),
        'priority' => 160
    ]);

    // Add controls for each legal link
    $legal_links = [
        'privacy' => __('Privacy Policy Link', 'amt-spice'),
        'terms' => __('Terms of Use Link', 'amt-spice'),
        'contact' => __('Contact Us Link', 'amt-spice')
    ];

    foreach ($legal_links as $key => $label) {
        // URL Setting
        $wp_customize->add_setting('amt_' . $key . '_link', [
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
        ]);
        
        // Text Setting
        $wp_customize->add_setting('amt_' . $key . '_text', [
            'default' => $key === 'privacy' ? 'Privacy Notice' : ($key === 'terms' ? 'Terms of Use' : 'Contact Us'),
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        ]);
        
        // URL Control
        $wp_customize->add_control('amt_' . $key . '_link', [
            'label' => $label . ' URL',
            'section' => 'amt_legal_links',
            'type' => 'url'
        ]);
        
        // Text Control
        $wp_customize->add_control('amt_' . $key . '_text', [
            'label' => $label . ' Text',
            'section' => 'amt_legal_links',
            'type' => 'text'
        ]);
        
// new page with customizer start
// new-page-with-sidebar.php

if (!function_exists('amt_customize_register')) :
function amt_customize_register($wp_customize) {
    // Create a new section in the Customizer
    $wp_customize->add_section('amt_theme_options', array(
        'title'    => __('Theme Options', 'your-theme'),
        'priority' => 30,
    ));

    // Default Header Image
    $wp_customize->add_setting('amt_page_header_image', array(
        'default' => get_template_directory_uri() . '/assets/images/default-header.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'amt_page_header_image',
        array(
            'label'    => __('Default Header Image', 'your-theme'),
            'section'  => 'amt_theme_options',
            'settings' => 'amt_page_header_image'
        )
    ));

    // Default Sidebar Title
    $wp_customize->add_setting('amt_default_sidebar_title', array(
        'default' => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('amt_default_sidebar_title', array(
        'label'    => __('Default Sidebar Title', 'your-theme'),
        'section'  => 'amt_theme_options',
        'type'     => 'text',
    ));
}
endif;
add_action('customize_register', 'amt_customize_register');
    }
// END new page with customizer
}
add_action('customize_register', 'amt_customize_register');