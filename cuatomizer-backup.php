
<?php
/**
 * AMT-Spice Customizer functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once(ABSPATH . 'wp-load.php');
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/'); // Define ABSPATH if not already defined
}
require_once(ABSPATH . 'wp-includes/l10n.php'); // Ensure localization functions are loaded

function amt_spice_customize_register($wp_customize) {
    // Add Theme Options Panel
    $wp_customize->add_panel('amt_theme_options', array(
        'title' => 'AMT-Spice Theme Options',
        'priority' => 1,
    ));
    
    // Header Section
    $wp_customize->add_section('amt_header', array(
        'title' => __('Header Settings', 'amt-spice'),
        'panel' => 'amt_theme_options',
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
    ));
    
    $wp_customize->add_setting('amt_hero_title', array(
        'default' => __('Book us today', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_hero_text', array(
        'default' => __('Get blush-free facts and stories about love, sex, and relationships.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
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
    ));
    
    $wp_customize->add_setting('amt_intro_title', array(
        'default' => __('Blush-free facts and stories about love, sex, and relationships.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_intro_text', array(
        'default' => __('Learn more about Blush-free facts and stories about love, sex, and relationships', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
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
    
    // Chat Support Section

    // Chat Support Section
$wp_customize->add_section('amt_chat_support_section', array(
    'title'    => __('Chat Support Section', 'amt'),
    'priority' => 120,
));

// Chat Title
$wp_customize->add_setting('amt_chat_title', array(
    'default'           => 'Our Impact',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('amt_chat_title', array(
    'label'    => __('Chat Section Title', 'amt'),
    'section'  => 'amt_chat_support_section',
    'type'     => 'text',
));

// Chat Text
$wp_customize->add_setting('amt_chat_text', array(
    'default'           => 'Our trained health educators and chat bot are available in real time.',
    'sanitize_callback' => 'sanitize_textarea_field',
));
$wp_customize->add_control('amt_chat_text', array(
    'label'    => __('Chat Section Text', 'amt'),
    'section'  => 'amt_chat_support_section',
    'type'     => 'textarea',
));

// Chat Button Text
$wp_customize->add_setting('amt_chat_button_text', array(
    'default'           => 'Chat Now',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('amt_chat_button_text', array(
    'label'    => __('Chat Button Text', 'amt'),
    'section'  => 'amt_chat_support_section',
    'type'     => 'text',
));

// Chat Button Link
$wp_customize->add_setting('amt_chat_button_link', array(
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control('amt_chat_button_link', array(
    'label'    => __('Chat Button Link', 'amt'),
    'section'  => 'amt_chat_support_section',
    'type'     => 'url',
));

// Chat Image
$wp_customize->add_setting('amt_chat_image', array(
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_chat_image', array(
    'label'    => __('Chat Section Image', 'amt'),
    'section'  => 'amt_chat_support_section',
)));

// Social Media Counters
$wp_customize->add_section('amt_social_counters_section', array(
    'title'    => __('Social Media Counters', 'amt'),
    'priority' => 121,
));

$social_platforms = array(
    'facebook' => array(
        'default' => 15000,
        'label'   => 'Facebook Followers'
    ),
    'instagram' => array(
        'default' => 9500,
        'label'   => 'Instagram Followers'
    ),
    'tiktok' => array(
        'default' => 12000,
        'label'   => 'TikTok Followers'
    ),
    'website' => array(
        'default' => 500000,
        'label'   => 'Monthly Website Visitors'
    )
);

foreach ($social_platforms as $platform => $data) {
    // Counter Value
    $wp_customize->add_setting("amt_counter_{$platform}", array(
        'default'           => $data['default'],
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control("amt_counter_{$platform}", array(
        'label'    => sprintf(__('%s Count', 'amt'), ucfirst($platform)),
        'section'  => 'amt_social_counters_section',
        'type'     => 'number',
    ));
    
    // Counter Label
    $wp_customize->add_setting("amt_counter_{$platform}_label", array(
        'default'           => $data['label'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("amt_counter_{$platform}_label", array(
        'label'    => sprintf(__('%s Label', 'amt'), ucfirst($platform)),
        'section'  => 'amt_social_counters_section',
        'type'     => 'text',
    ));
}
    // Social Counter Settings
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('amt_counter_' . $i . '_value', array(
            'default' => '',
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_setting('amt_counter_' . $i . '_label', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
    }
    
    // Services Section
    $wp_customize->add_section('amt_services', array(
        'title' => __('Services Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
    ));
    
    $wp_customize->add_setting('amt_services_title', array(
        'default' => __('Our Services', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('amt_service_title_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_setting('amt_service_text_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
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
    
    // Testimonials Section
    $wp_customize->add_section('amt_testimonials', array(
        'title' => __('Testimonials Section', 'amt-spice'),
        'panel' => 'amt_theme_options',
    ));
    
    $wp_customize->add_setting('amt_testimonials_title', array(
        'default' => __('Testimonials Get Blush-free facts and stories about love, sex, and relationships', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_testimonials_text', array(
        'default' => __('Visit our website lovemattersafrica.com today.', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_testimonials_button_text', array(
        'default' => __('Learn More', 'amt-spice'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('amt_testimonials_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    // Footer Section
    $wp_customize->add_section('amt_footer', array(
        'title' => __('Footer Settings 44', 'amt-spice'),
        'panel' => 'amt_theme_options',
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
        'label' => 'Footer Column 1 Title',
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
add_action('customize_register', 'amt_spice_customize_register');

$wp_customize->add_control('amt_copyright_text_control', array(
    'label' => __('Copyright Text', 'amt-spice'),
    'section' => 'amt_footer',
    'settings' => 'amt_copyright_text',
    'type' => 'text',
));
}
add_action('customize_register', 'amt_spice_customize_register');