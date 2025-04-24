<?php
/**
 * Template tags for AMT-Spice theme
 *
 * @package AMT-Spice
 */

if (!function_exists('amt_spice_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function amt_spice_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'amt-spice'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('amt_spice_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function amt_spice_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'amt-spice'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('amt_spice_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function amt_spice_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'amt-spice'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'amt-spice') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'amt-spice'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'amt-spice') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'amt-spice'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'amt-spice'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('amt_spice_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function amt_spice_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                    the_post_thumbnail(
                        'post-thumbnail',
                        array(
                            'alt' => the_title_attribute(array('echo' => false)),
                        )
                    );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }
endif;

/**
 * Display social media icons from theme customizer settings
 */
function amt_spice_social_icons() {
    $social_links = array(
        'facebook' => get_theme_mod('amt_social_facebook'),
        'twitter' => get_theme_mod('amt_social_twitter'),
        'instagram' => get_theme_mod('amt_social_instagram'),
        'youtube' => get_theme_mod('amt_social_youtube'),
        'linkedin' => get_theme_mod('amt_social_linkedin')
    );
    
    $output = '<div class="social-icons">';
    
    foreach ($social_links as $platform => $url) {
        if ($url) {
            $output .= sprintf(
                '<a href="%s" class="text-white mx-2" target="_blank" rel="noopener noreferrer"><i class="fab fa-%s fa-2x"></i></a>',
                esc_url($url),
                esc_attr($platform)
            );
        }
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Display footer navigation menu
 */
function amt_spice_footer_nav($location = 'footer1') {
    if (has_nav_menu($location)) {
        wp_nav_menu(array(
            'theme_location' => $location,
            'menu_class' => 'list-unstyled',
            'container' => false,
            'depth' => 1
        ));
    }
}

/**
 * Display the custom logo
 */
function amt_spice_custom_logo($footer = false) {
    $logo = $footer ? get_theme_mod('amt_footer_logo') : get_theme_mod('amt_logo');
    
    if ($logo) {
        printf(
            '<img src="%s" alt="%s" class="%s">',
            esc_url($logo),
            esc_attr(get_bloginfo('name')),
            $footer ? 'footer-logo' : 'navbar-brand-logo'
        );
    } else {
        bloginfo('name');
    }
}

/**
 * Display the hero section
 */
function amt_spice_hero_section() {
    $hero_title = get_theme_mod('amt_hero_title', 'Book us today');
    $hero_text = get_theme_mod('amt_hero_text', 'Get blush-free facts and stories about love, sex, and relationships.');
    $hero_button_text = get_theme_mod('amt_hero_button_text', 'Get Started');
    $hero_button_link = get_theme_mod('amt_hero_button_link', '#');
    $hero_background = get_theme_mod('amt_hero_background');
    
    $style = $hero_background ? 'style="background-image: url(' . esc_url($hero_background) . ')"' : '';
    
    echo '<section class="hero-section text-left" ' . $style . '>';
    echo '<div class="container">';
    echo '<div class="hero-content">';
    echo '<h1>' . esc_html($hero_title) . '</h1>';
    echo '<p>' . esc_html($hero_text) . '</p>';
    echo '<a href="' . esc_url($hero_button_link) . '" class="btn btn-primary">' . esc_html($hero_button_text) . '</a>';
    echo '</div></div></section>';
}

/**
 * Display the social media counters
 */
function amt_spice_social_counters() {
    $counters = array(
        array(
            'icon' => 'facebook',
            'target' => get_theme_mod('amt_counter_facebook', 15000),
            'label' => get_theme_mod('amt_counter_facebook_label', 'Facebook Followers')
        ),
        array(
            'icon' => 'instagram',
            'target' => get_theme_mod('amt_counter_instagram', 9500),
            'label' => get_theme_mod('amt_counter_instagram_label', 'Instagram Followers')
        ),
        array(
            'icon' => 'tiktok',
            'target' => get_theme_mod('amt_counter_tiktok', 12000),
            'label' => get_theme_mod('amt_counter_tiktok_label', 'TikTok Followers')
        ),
        array(
            'icon' => 'globe',
            'target' => get_theme_mod('amt_counter_website', 500000),
            'label' => get_theme_mod('amt_counter_website_label', 'Monthly Website Visitors')
        )
    );
    
    $output = '<div class="row mt-5">';
    
    foreach ($counters as $counter) {
        if ($counter['target']) {
            $output .= '<div class="col-md-3 col-6 mb-4">';
            $output .= '<div class="counter-item">';
            $output .= '<i class="fab fa-' . esc_attr($counter['icon']) . ' fa-2x mb-2"></i>';
            $output .= '<div class="counter" data-target="' . esc_attr($counter['target']) . '">0</div>';
            $output .= '<span>' . esc_html($counter['label']) . '</span>';
            $output .= '</div></div>';
        }
    }
    
    $output .= '</div>';
    
    return $output;
}