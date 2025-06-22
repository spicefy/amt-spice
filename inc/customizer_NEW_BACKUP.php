<?php
/**
 * AMT-Spice Customizer functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}




function amt_spice_customize_register($wp_customize) {


// Add section for Navigation Settings
$wp_customize->add_section( 'nav_typography_section', array(
    'title'       => __( 'Navigation Typography', 'amt-spice' ),
    'priority'    => 30,
    'description' => __( 'Change font size for the navigation menu.', 'amt-spice' ),
) );

// Add setting for Nav Font Size
$wp_customize->add_setting( 'nav_font_size', array(
    'default'           => '16px',
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for Nav Font Size
$wp_customize->add_control( 'nav_font_size_control', array(
    'label'    => __( 'Navigation Font Size (e.g., 16px, 1em)', 'amt-spice' ),
    'section'  => 'nav_typography_section',
    'settings' => 'nav_font_size',
    'type'     => 'text',
) );

// Font Weight Setting
$wp_customize->add_setting( 'nav_font_weight', array(
    'default'           => '400',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'nav_font_weight_control', array(
    'label'    => __( 'Navigation Font Weight (e.g., 400, 700, bold)', 'amt-spice' ),
    'section'  => 'nav_typography_section',
    'settings' => 'nav_font_weight',
    'type'     => 'text',
) );

    //page header



    $wp_customize->add_section('custom_page_header_section', array(
        'title' => __('Page Header Settings', 'amt-spice'),
        'priority' => 30,
    ));

    // Background Color
    $wp_customize->add_setting('page_header_bg_color', array(
        'default' => '#2c3e50',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_header_bg_color', array(
        'label' => __('Background Color', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_bg_color',
    )));

    // Text Color
    $wp_customize->add_setting('page_header_text_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_header_text_color', array(
        'label' => __('Text Color', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_text_color',
    )));

    // Padding
    $wp_customize->add_setting('page_header_padding', array(
        'default' => '40px',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('page_header_padding', array(
        'label' => __('Header Padding', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_padding',
        'type' => 'text',
    ));

    $wp_customize->add_setting('page_header_image_max_height', array(
        'default' => '300px',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('page_header_image_max_height', array(
        'label' => __('Featured Image Max Height (e.g. 300px)', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'type' => 'text',
    ));

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
    $wp_customize->add_setting('amt_hero_title_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('amt_hero_title_enabled', array(
        'type'    => 'checkbox',
        'section' => 'amt_hero', 
        'label'   => __('Enable Hero content except image', 'amt-spice'),
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


//timeline page

// Add Timeline Section
$wp_customize->add_section('timeline_section', array(
    'title' => __('Company Timeline', 'your-theme'),
    'priority' => 30,
));

// Setting for Timeline Title
$wp_customize->add_setting('timeline_title', array(
    'default' => 'Company History Timeline with Milestones Achieved',
    'transport' => 'refresh',
));

$wp_customize->add_control('timeline_title_control', array(
    'label' => __('Timeline Title', 'your-theme'),
    'section' => 'timeline_section',
    'settings' => 'timeline_title',
    'type' => 'text',
));

// Setting for Timeline Description
$wp_customize->add_setting('timeline_description', array(
    'default' => 'This section covers details regarding firm history in terms of milestones achieved presented in timeline format.',
    'transport' => 'refresh',
));

$wp_customize->add_control('timeline_description_control', array(
    'label' => __('Timeline Description', 'your-theme'),
    'section' => 'timeline_section',
    'settings' => 'timeline_description',
    'type' => 'textarea',
));

// Repeater for Timeline Items
$wp_customize->add_setting('timeline_items', array(
    'default' => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'timeline_sanitize_repeater'
));

$wp_customize->add_control(new Timeline_Repeater_Control($wp_customize, 'timeline_items_control', array(
    'label' => __('Timeline Items', 'your-theme'),
    'section' => 'timeline_section',
    'settings' => 'timeline_items',
    'fields' => array(
        'year' => array(
            'type' => 'text',
            'label' => __('Year', 'your-theme'),
        ),
        'month' => array(
            'type' => 'text',
            'label' => __('Month', 'your-theme'),
        ),
        'event' => array(
            'type' => 'text',
            'label' => __('Event Description', 'your-theme'),
        )
    )
)));

    //demographic page
    // Section for Demography Page Customization
    $wp_customize->add_section('demography_page_section', array(
        'title'    => __('Demography Page', 'amt-spice'),
        'priority' => 30,
    ));

    // Setting for Page Title
    $wp_customize->add_setting('demography_page_title', array(
        'default'   => 'LOVEMATTERS AFRICA',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('demography_page_title_control', array(
        'label'    => __('Page Title', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'demography_page_title',
        'type'     => 'text',
    ));

    // Setting for Page Description
    $wp_customize->add_setting('demography_page_description', array(
        'default'   => 'Blush-free facts and stories about love, sex, and relationships',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('demography_page_description_control', array(
        'label'    => __('Page Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'demography_page_description',
        'type'     => 'textarea',
    ));

    // Setting for Primary Audience Description
    $wp_customize->add_setting('primary_audience_description', array(
        'default'   => 'Young people 18-35 years old in all their diversity.',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('primary_audience_description_control', array(
        'label'    => __('Primary Audience Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'primary_audience_description',
        'type'     => 'textarea',
    ));

    // Setting for Secondary Audience Description
    $wp_customize->add_setting('secondary_audience_description', array(
        'default'   => 'Parents, guardians, and key decision-makers.',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('secondary_audience_description_control', array(
        'label'    => __('Secondary Audience Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'secondary_audience_description',
        'type'     => 'textarea',
    ));

    // Setting for Demographic Data (age groups)
    $wp_customize->add_setting('age_groups', array(
        'default'   => json_encode(["18-35 Years", "35-44 Years", "44-55 Years", "55+ Years"]),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('age_groups_control', array(
        'label'    => __('Age Groups', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'age_groups',
        'type'     => 'text',
    ));

    // Setting for Demographic Data (percentages)
    $wp_customize->add_setting('demographic_data', array(
        'default'   => json_encode([80, 10, 6, 4]),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('demographic_data_control', array(
        'label'    => __('Demographic Data (percentages)', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'demographic_data',
        'type'     => 'text',
    ));
    


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
    


    // Add section
    $wp_customize->add_section( 'gamba_testimonials_section', array(
        'title'    => __( 'Testimonials Settings', 'amt-spice' ),
        'priority' => 30,
    ) );

    // Section title setting
    $wp_customize->add_setting( 'gamba_testimonials_title', array(
        'default'           => 'What Our Clients Say',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'gamba_testimonials_title', array(
        'label'   => __( 'Section Title', 'amt-spice' ),
        'section' => 'gamba_testimonials_section',
        'type'    => 'text',
    ) );

    // Number of testimonials
    $wp_customize->add_setting( 'gamba_testimonials_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'gamba_testimonials_count', array(
        'label'   => __( 'Number of Testimonials to Display', 'amt-spice' ),
        'section' => 'gamba_testimonials_section',
        'type'    => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 20
        ),
    ) );
    
    
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
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'amt_footer_logo_control', array(
        'label' => __('Footer Logo', 'amt-spice'),
        'section' => 'amt_footer',
        'settings' => 'amt_footer_logo',
    )));
    
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




    $wp_customize->add_setting('primary_color', [
        'default' => '#009bbe',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', [
        'label' => __('Primary Color', 'amt_spice'),
        'section' => 'colors',
    ]));

    $wp_customize->add_setting('secondary_color', [
        'default' => '#fd153a',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', [
        'label' => __('Secondary Color', 'amt_spice'),
        'section' => 'colors',
    ]));

    $wp_customize->add_setting('custom_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_bg_color', [
        'label' => __('Background Color', 'amt_spice'),
        'section' => 'colors',
    ]));

    $wp_customize->add_setting('text_color', [
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', [
        'label' => __('Text Color', 'amt_spice'),
        'section' => 'colors',
    ]));

    $wp_customize->add_setting('text_white_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_white_color', [
        'label' => __('Text White Color', 'amt_spice'),
        'section' => 'colors',
    ]));
	
	$wp_customize->add_setting('menu_link_hover_color', [
        'default' => '#fd153a',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_color', [
        'label' => __('Menu Link Hover Color', 'amt_spice'),
        'section' => 'colors',
    ]));

    $wp_customize->add_setting('body_font', [
        'default' => 'Roboto',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
	
    $wp_customize->add_control('body_font', [
        'label' => __('Body Font', 'amt_spice'),
        'section' => 'title_tagline',
        'type' => 'select',
        'choices' => [
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Poppins' => 'Poppins',
            'Inter' => 'Inter',
            'Manrope' => 'Manrope',
			'Arial' => 'Arial'
        ]
    ]);
	
	$wp_customize->add_setting('navbar_position', [
    'default' => 'normal',
    'transport' => 'refresh',
    'sanitize_callback' => function($value) {
        return in_array($value, ['normal', 'fixed-top', 'sticky-top']) ? $value : 'normal';
    },
]);
	// Add Control for Navbar Position
$wp_customize->add_control('navbar_position', [
    'label' => __('Navbar Position', 'amt_spice'),
    'section' => 'colors', // or create your own section if you prefer
    'type' => 'select',
    'choices' => [
        'normal' => __('Normal', 'amt_spice'),
        'fixed-top' => __('Fixed Top', 'amt_spice'),
		'sticky-top' => __('Sticky Top', 'amt_spice'),
    ],
]);
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
        'title'    => __('Theme Options', 'amt-spice'),
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
            'label'    => __('Default Header Image', 'amt-spice'),
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
        'label'    => __('Default Sidebar Title', 'amt-spice'),
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