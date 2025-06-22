<?php
/**
 * AMT-Spice Theme Functions
 * 
 * @package amt-spice
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define theme version constant
define('AMT_SPICE_VERSION', '1.0.0');

/**
 * Register widget areas (sidebars)
 */
function amt_spice_widgets_init() {
    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'amt-spice'),
        'id'            => 'blog-sidebar',
        'description'   => __('Widgets in this area will be shown on the blog sidebar.', 'amt-spice'),
        'before_widget' => '<div id="%1$s" class="widget %2$s card card-body mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h5 widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'amt_spice_widgets_init');

/**
 * Custom Search Widget with Bootstrap styling
 */
class Custom_Search_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_search_widget',
            __('Styled Search Form', 'amt-spice'),
            array('description' => __('A custom styled blog search form.', 'amt-spice'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <form role="search" method="get" class="input-group mb-4" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text"
                   class="form-control rounded pe-5"
                   placeholder="<?php esc_attr_e('Search the blog...', 'amt-spice'); ?>"
                   value="<?php echo get_search_query(); ?>"
                   name="s">
            <i class="bx bx-search position-absolute top-50 end-0 translate-middle-y me-3 fs-lg zindex-5"></i>
        </form>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        echo '<p>' . __('Displays a styled search bar.', 'amt-spice') . '</p>';
    }

    public function update($new_instance, $old_instance) {
        return array();
    }
}

/**
 * Register the custom search widget
 */
function register_custom_search_widget() {
    register_widget('Custom_Search_Widget');
}
add_action('widgets_init', 'register_custom_search_widget');

/**
 * Popular Posts Widget with Bootstrap styling
 */
class Custom_Popular_Posts_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_popular_posts_widget',
            __('Styled Popular Posts', 'amt-spice'),
            array('description' => __('Displays popular posts using custom Bootstrap styling.', 'amt-spice'))
        );
    }

    public function widget($args, $instance) {
        $title  = apply_filters('widget_title', $instance['title'] ?? '');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;

        echo $args['before_widget'];
        ?>
        <span class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-secondary opacity-10 rounded-3"></span>
        <div class="position-relative zindex-2">
            <?php if (!empty($title)) : ?>
                <h3 class="h5"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <ul class="list-unstyled mb-0">
                <?php
                $popular_posts = new WP_Query(array(
                    'posts_per_page' => $number,
                    'orderby'        => 'comment_count',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                ));

                if ($popular_posts->have_posts()) :
                    while ($popular_posts->have_posts()) : $popular_posts->the_post();
                        $post_id = get_the_ID();
                        $likes   = get_post_meta($post_id, 'post_likes', true);
                        $shares  = get_post_meta($post_id, 'post_shares', true);
                        ?>
                        <li class="border-bottom pb-3 mb-3">
                            <h4 class="h6 mb-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <div class="d-flex align-items-center text-muted pt-1">
                                <div class="fs-xs border-end pe-3 me-3">
                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'amt-spice'); ?>
                                </div>
                                <div class="d-flex align-items-center me-3">
                                    <i class="bx bx-like fs-base me-1"></i>
                                    <span class="fs-xs"><?php echo $likes ? esc_html($likes) : 0; ?></span>
                                </div>
                                <div class="d-flex align-items-center me-3">
                                    <i class="bx bx-comment fs-base me-1"></i>
                                    <span class="fs-xs"><?php echo get_comments_number(); ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-share-alt fs-base me-1"></i>
                                    <span class="fs-xs"><?php echo $shares ? esc_html($shares) : 0; ?></span>
                                </div>
                            </div>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<li>' . __('No popular posts found.', 'amt-spice') . '</li>';
                endif;
                ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title  = !empty($instance['title']) ? $instance['title'] : __('Popular posts', 'amt-spice');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'amt-spice'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_attr_e('Number of posts to show:', 'amt-spice'); ?>
            </label>
            <input class="tiny-text"
                   id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   type="number"
                   step="1"
                   min="1"
                   value="<?php echo esc_attr($number); ?>"
                   size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return array(
            'title'  => sanitize_text_field($new_instance['title']),
            'number' => absint($new_instance['number']),
        );
    }
}

/**
 * Register the popular posts widget
 */
function register_custom_popular_posts_widget() {
    register_widget('Custom_Popular_Posts_Widget');
}
add_action('widgets_init', 'register_custom_popular_posts_widget');

/**
 * Categories List Widget with Bootstrap styling
 */
class Custom_Categories_List_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_categories_list_widget',
            __('Styled Categories List', 'amt-spice'),
            array('description' => __('Displays categories in a styled Bootstrap card.', 'amt-spice'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title'] ?? '');

        echo $args['before_widget'];
        if (!empty($title)) : ?>
            <h3 class="h5"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <ul class="nav flex-column fs-sm">
            <li class="nav-item mb-1">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="nav-link py-1 px-0 active">
                    <?php _e('All topics', 'amt-spice'); ?> <span class="fw-normal opacity-60 ms-1">(<?php echo wp_count_posts()->publish; ?>)</span>
                </a>
            </li>
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
            ));
            foreach ($categories as $category) {
                $cat_link  = get_category_link($category->term_id);
                $cat_name  = esc_html($category->name);
                $cat_count = $category->count;
                ?>
                <li class="nav-item mb-1">
                    <a href="<?php echo esc_url($cat_link); ?>" class="nav-link py-1 px-0">
                        <?php echo $cat_name; ?>
                        <span class="fw-normal opacity-60 ms-1">(<?php echo $cat_count; ?>)</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Categories', 'amt-spice');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'amt-spice'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

/**
 * Register the categories list widget
 */
function register_custom_categories_list_widget() {
    register_widget('Custom_Categories_List_Widget');
}
add_action('widgets_init', 'register_custom_categories_list_widget');

/**
 * Custom comments display template
 */
function amt_spice_comments_display($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <div class="py-4">
        <div class="d-flex align-items-center justify-content-between pb-2 mb-1">
            <div class="d-flex align-items-center me-3">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-circle')); ?>
                <div class="ps-3">
                    <h6 class="fw-semibold mb-0"><?php echo get_comment_author(); ?></h6>
                    <span class="fs-sm text-muted">
                        <?php printf(__('%1$s at %2$s', 'amt-spice'), get_comment_date(), get_comment_time()); ?>
                    </span>
                </div>
            </div>
            <a href="<?php echo esc_url(get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))); ?>" class="nav-link fs-sm px-0">
                <i class="bx bx-share fs-lg me-2"></i>
                <?php _e('Reply', 'amt-spice'); ?>
            </a>
        </div>
        <p class="mb-0"><?php comment_text(); ?></p>
    </div>
    <?php
}

/**
 * Calculate estimated reading time for a post (assuming 200 words/min)
 */
function amt_spice_estimated_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $minutes = ceil($word_count / 200);
    return sprintf(_n('%d min', '%d mins', $minutes, 'amt-spice'), $minutes);
}

/**
 * Custom breadcrumbs function
 */
function custom_breadcrumbs() {
    $separator = '<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-1"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>';
    $home_title = 'Home';

    if (is_front_page()) {
        return;
    }

    echo '
    <style>.breadcrumb-item + .breadcrumb-item::before { display: none; }</style>
    <nav class="container py-1 mb-lg-2 mt-lg-3" aria-label="breadcrumb"><ol class="breadcrumb mb-0">';

    // Home link
    echo '<li class="breadcrumb-item"><a href="' . home_url() . '">
        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 me-1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> ' . $home_title . '</a></li>';

    if (is_category() || is_single()) {
        $categories = get_the_category();
        if ($categories && !is_page()) {
            foreach ($categories as $category) {
                echo '<li class="breadcrumb-item"><a href="' . get_category_link($category->term_id) . '">' . $separator . esc_html($category->name) . '</a></li>';
            }
        }
        if (is_single()) {
            echo '<li class="breadcrumb-item">' . $separator . get_the_title() . '</li>';
        }
    } elseif (is_tag()) {
        echo '<li class="breadcrumb-item active">' . $separator . single_tag_title('', false) . '</li>';
    } elseif (is_page()) {
        $parent_id = wp_get_post_parent_id(get_the_ID());
        if ($parent_id) {
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = wp_get_post_parent_id($page->ID);
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            echo implode('', $breadcrumbs);
        }
        echo '<li class="breadcrumb-item">' . $separator . get_the_title() . '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item">' . $separator . 'Search results for: "' . get_search_query() . '"</li>';
    } elseif (is_author()) {
        echo '<li class="breadcrumb-item">' . $separator . 'Articles by ' . get_the_author() . '</li>';
    } elseif (is_404()) {
        echo '<li class="breadcrumb-item">' . $separator . '404 Error</li>';
    }

    echo '</ol></nav>';
}

/**
 * Theme setup function
 */
function amt_spice_setup() {
    load_theme_textdomain('amt-spice', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));

    register_nav_menus(array(
        'primary'      => __('Primary Menu', 'amt-spice'),
        'footer-1'     => __('Footer Column 1', 'amt-spice'),
        'footer-2'     => __('Footer Column 2', 'amt-spice'),
        'footer-3'     => __('Footer Column 3', 'amt-spice'),
        'sidebar-menu' => __('Sidebar Menu', 'amt-spice')
    ));

    // Register a block style for the paragraph block
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'fancy-paragraph',
            'label' => __('Fancy Paragraph', 'amt-spice'),
        )
    );

    // Register a custom block pattern
    register_block_pattern(
        'amt-spice/my-pattern',
        array(
            'title'       => __('My Pattern', 'amt-spice'),
            'description' => _x('A custom block pattern', 'Block pattern description', 'amt-spice'),
            'content'     => "<!-- wp:paragraph --><p>Pattern Content</p><!-- /wp:paragraph -->",
        )
    );
}
add_action('after_setup_theme', 'amt_spice_setup');

/**
 * Enqueue scripts and styles
 */
function amt_spice_scripts() {
    // Font Awesome CDN
    wp_enqueue_style('font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Theme styles
    wp_enqueue_style('amt-spice-timeline',
        get_template_directory_uri() . '/assets/css/timeline.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-swiperbundle',
        get_template_directory_uri() . '/assets/css/swiper-bundle.min.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-thememin',
        get_template_directory_uri() . '/assets/css/theme.min.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_script('wp-util');
    wp_enqueue_script(
        'timeline-repeater-control',
        get_template_directory_uri() . '/assets/js/timeline-repeater-control.js',
        array('jquery', 'jquery-ui-sortable', 'customize-controls', 'wp-util'),
        '1.0.0',
        true
    );
    wp_enqueue_style(
        'timeline-repeater-control',
        get_template_directory_uri() . '/assets/css/timeline-repeater-control.css',
        array(),
        '1.0.0'
    );
    wp_enqueue_style('amt-spice-style', get_stylesheet_uri());
    wp_enqueue_style('amt-spice-custom',
        get_template_directory_uri() . '/assets/css/styles.css?' . rand(),
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-minbox',
        get_template_directory_uri() . '/assets/css/minbox.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('jobs-listing-section',
        get_template_directory_uri() . '/assets/css/jobs-listing-section.css',
        array(),
        '1.0'
    );

    // Swiper JS and initializers
    wp_enqueue_script('amt-spice-swiperinjs',
        get_template_directory_uri() . '/assets/js/swiper-bundle.min.js',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_script('amt-spice-swiperinitjs',
        get_template_directory_uri() . '/assets/js/swiper-init.js',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_script('amt-spice-thememinjs',
        get_template_directory_uri() . '/assets/js/theme.min.js',
        array(),
        AMT_SPICE_VERSION
    );

    // Chart.js CDN
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

    // Enqueue comment-reply script if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Enqueue Google Fonts based on theme mod
    $font = get_theme_mod('body_font', 'Roboto');
    $font_slug = str_replace(' ', '+', $font);
    wp_enqueue_style('google-fonts', "https://fonts.googleapis.com/css2?family={$font_slug}:wght@400;700&display=swap", false);
}
add_action('wp_enqueue_scripts', 'amt_spice_scripts');

/**
 * Register Testimonial custom post type
 */
function gamba_testimonial_type() {
    $args = array(
        'public' => true,
        'query_var' => 'testimonial',
        'rewrite' => array(
            'slug' => 'testimonials',
            'with_front' => false
        ),
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'revisions'
        ),
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new' => 'Add New Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'edit_item' => 'Edit Testimonial',
            'new_item' => 'New Testimonial',
            'view_item' => 'View Testimonial',
            'search_items' => 'Search Testimonials',
            'not_found' => 'No testimonials found',
            'not_found_in_trash' => 'No testimonials found in Trash',
        ),
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'gamba_testimonial_type');

/**
 * Add meta boxes for testimonials
 */
function gamba_testimonial_meta_boxes() {
    add_meta_box(
        'gamba_testimonial_details',
        'Customer Details',
        'gamba_testimonial_meta_box_callback',
        'testimonial',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'gamba_testimonial_meta_boxes');

/**
 * Testimonial meta box callback
 */
function gamba_testimonial_meta_box_callback($post) {
    $name = get_post_meta($post->ID, '_testimonial_name', true);
    $designation = get_post_meta($post->ID, '_testimonial_designation', true);

    wp_nonce_field('gamba_save_testimonial_meta', 'gamba_testimonial_nonce');

    echo '<p><label for="testimonial_name">Customer Name</label><br>';
    echo '<input type="text" id="testimonial_name" name="testimonial_name" value="' . esc_attr($name) . '" class="widefat" /></p>';

    echo '<p><label for="testimonial_designation">Designation</label><br>';
    echo '<input type="text" id="testimonial_designation" name="testimonial_designation" value="' . esc_attr($designation) . '" class="widefat" /></p>';
}

/**
 * Save testimonial meta data
 */
function gamba_save_testimonial_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['gamba_testimonial_nonce']) ||
         !wp_verify_nonce($_POST['gamba_testimonial_nonce'], 'gamba_save_testimonial_meta')) {
        return;
    }

    // Prevent autosave from overwriting
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Save Customer Name
    if (isset($_POST['testimonial_name'])) {
        update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['testimonial_name']));
    }

    // Save Designation
    if (isset($_POST['testimonial_designation'])) {
        update_post_meta($post_id, '_testimonial_designation', sanitize_text_field($_POST['testimonial_designation']));
    }
}
add_action('save_post', 'gamba_save_testimonial_meta');

// Include required files
if (!class_exists('WP_Bootstrap_Navwalker')) {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
require_once get_template_directory() . '/inc/customizer.php'; // Customizer settings
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/template-parts/breadcrumbs.php';
require_once get_template_directory() . '/inc/team-settings.php';
require_once get_template_directory() . '/inc/job-listing-settings.php';

/**
 * Add custom classes to sidebar menu links
 */
function add_menu_link_classes($atts, $item, $args) {
    if ($args->theme_location === 'sidebar-menu') {
        $atts['class'] = isset($atts['class']) 
            ? $atts['class'] . ' fw-s ' 
            : 'fw-s ';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_classes', 10, 3);

/**
 * JSON Sanitization callback for Customizer
 */
function amt_sanitize_json($input) {
    $decoded = json_decode($input, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return $input;
    }
    return '';
}

/**
 * Enqueue Customizer preview JS
 */
function amt_spice_customize_preview_js() {
    wp_enqueue_script('amt_spice-customizer', get_stylesheet_directory_uri() . '/customizer.js', ['customize-preview'], null, true);
}
add_action('customize_preview_init', 'amt_spice_customize_preview_js');

/**
 * Generate dynamic styles based on theme modifications
 */
function amt_spice_dynamic_styles() {
    $primary = get_theme_mod('primary_color', '#009bbe');
    $secondary = get_theme_mod('secondary_color', '#fd153a');
    $background = get_theme_mod('custom_bg_color', '#ffffff');
    $text = get_theme_mod('text_color', '#333333');
    $text_white = get_theme_mod('text_white_color', '#ffffff');
    $hover_color = get_theme_mod('menu_link_hover_color', '#fd153a');
    $body_font = get_theme_mod('body_font', "'Arial', sans-serif");
    $paddingforfixed = "";
    $navbar_position = get_theme_mod('navbar_position', 'normal');
    $nav_font_size = get_theme_mod('nav_font_size', '16px');
    $font_weight = get_theme_mod('nav_font_weight', '400');

    if ($navbar_position === 'fixed-top') {
        $paddingforfixed = "padding-top: 80px;";
    }
    
    echo "<style>
        :root {
            --font-family: {$body_font};
            --primary-color: {$primary};
            --secondary-color: {$secondary};
            --background-color: {$background};
            --text-color: {$text};
            --text-white: {$text_white};
            --footer-hover-color: {$hover_color};
        }
        .navbar-nav {
            --si-nav-link-font-weight: {$font_weight};
        }
        .navbar {
            --si-navbar-hover-color: {$hover_color};
            --si-navbar-active-color: {$hover_color};
            --si-nav-link-font-size: {$nav_font_size}
        }
        body {
            {$paddingforfixed}
        }
        .dropdown-menu {
            --si-dropdown-font-size: {$nav_font_size};
        }
        .nav-link {
            font-size: var(--si-nav-link-font-size);
        }
    </style>";
}
add_action('wp_head', 'amt_spice_dynamic_styles');

/**
 * Sanitize repeater field input for Customizer
 */
function amt_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    if (is_array($input_decoded)) {
        return wp_json_encode($input_decoded);
    }
    return '';
}

/**
 * Add default timeline CSS if not present in Additional CSS
 */
function add_default_timeline_css() {
    $custom_css = wp_get_custom_css();
    if (strpos($custom_css, '.timeline') === false) {
        $css = "
            /* Timeline Styles */
            .timeline {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 0;
            }
            .timeline::after {
                content: '';
                position: absolute;
                width: 6px;
                background-color: #0d6efd;
                top: 0;
                bottom: 0;
                left: 50%;
                margin-left: -3px;
                border-radius: 3px;
            }
            .timeline-item {
                padding: 10px 40px;
                position: relative;
                width: 50%;
                box-sizing: border-box;
            }
            .timeline-item::after {
                content: '';
                position: absolute;
                width: 25px;
                height: 25px;
                background-color: white;
                border: 4px solid #0d6efd;
                border-radius: 50%;
                top: 15px;
                z-index: 1;
            }
            .timeline-item-left { left: 0; }
            .timeline-item-right { left: 50%; }
            .timeline-item-left::after { right: -12px; }
            .timeline-item-right::after { left: -12px; }
            .timeline-content {
                padding: 20px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .timeline-date {
                font-weight: bold;
                color: #0d6efd;
                margin-bottom: 10px;
            }
            .timeline-month { display: block; font-size: 1.2rem; }
            .timeline-year { display: block; font-size: 1.5rem; }
            .timeline-event { font-size: 1rem; line-height: 1.5; }
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .timeline::after { left: 31px; }
                .timeline-item { width: 100%; padding-left: 70px; padding-right: 25px; }
                .timeline-item::after { left: 18px; }
                .timeline-item-left, .timeline-item-right { left: 0; }
                .timeline-item-left::after, .timeline-item-right::after { left: 18px; }
            }
        ";
        wp_update_custom_css_post($custom_css . $css);
    }
}
add_action('after_setup_theme', 'add_default_timeline_css');

/**
 * Timeline Repeater Customizer Control
 */
if (class_exists('WP_Customize_Control')) {
    class Timeline_Repeater_Control extends WP_Customize_Control {
        public $type = 'timeline_repeater';
        public $fields = array();
        
        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
            if (isset($args['fields'])) {
                $this->fields = $args['fields'];
            }
        }

        // Render the control content
        public function render_content() {
            ?>
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
            </label>
            <div class="timeline-repeater" data-id="<?php echo esc_attr($this->id); ?>">
                <div class="timeline-repeater-items">
                    <?php
                    $value = json_decode($this->value(), true);
                    if (!empty($value)) {
                        foreach ($value as $i => $item) {
                            $this->render_item($i, $item);
                        }
                    }
                    ?>
                </div>
                <button type="button" class="button timeline-repeater-add"><?php esc_html_e('Add Timeline Item', 'amt-spice'); ?></button>
                <input type="hidden" class="timeline-repeater-data" <?php $this->link(); ?>>
            </div>
            <?php
        }

        // Render each timeline repeater item
        protected function render_item($index, $item = array()) {
            ?>
            <div class="timeline-repeater-item" data-index="<?php echo esc_attr($index); ?>">
                <div class="timeline-repeater-item-header">
                    <span class="timeline-repeater-item-title"><?php printf(esc_html__('Item #%d', 'amt-spice'), $index + 1); ?></span>
                    <button type="button" class="button timeline-repeater-item-remove"><?php esc_html_e('Remove', 'amt-spice'); ?></button>
                </div>
                <div class="timeline-repeater-item-fields">
                    <?php foreach ($this->fields as $field_name => $field) : ?>
                        <div class="timeline-repeater-field">
                            <label>
                                <?php if (!empty($field['label'])) : ?>
                                    <span class="timeline-repeater-field-label"><?php echo esc_html($field['label']); ?></span>
                                <?php endif; ?>
                                <?php if ($field['type'] === 'text') : ?>
                                    <input type="text" 
                                           class="timeline-repeater-field-control" 
                                           data-field="<?php echo esc_attr($field_name); ?>" 
                                           value="<?php echo isset($item[$field_name]) ? esc_attr($item[$field_name]) : ''; ?>">
                                <?php elseif ($field['type'] === 'textarea') : ?>
                                    <textarea class="timeline-repeater-field-control" 
                                              data-field="<?php echo esc_attr($field_name); ?>"><?php echo isset($item[$field_name]) ? esc_textarea($item[$field_name]) : ''; ?></textarea>
                                <?php endif; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}

/**
 * Sanitize timeline repeater input for Customizer
 */
function timeline_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    if (!is_array($input_decoded)) {
        return '';
    }
    $output = array();
    foreach ($input_decoded as $item) {
        $sanitized_item = array();
        if (isset($item['year'])) {
            $sanitized_item['year'] = sanitize_text_field($item['year']);
        }
        if (isset($item['month'])) {
            $sanitized_item['month'] = sanitize_text_field($item['month']);
        }
        if (isset($item['event'])) {
            $sanitized_item['event'] = sanitize_text_field($item['event']);
        }
        $output[] = $sanitized_item;
    }
    return json_encode($output);
}

/**
 * Register shortcode for the jobs listing section
 */
function amt_spice_jobs_listing_section_shortcode() {
    ob_start();
    get_template_part('template-parts/jobs-listing-section');
    return ob_get_clean();
}
add_shortcode('jobs_listing_section', 'amt_spice_jobs_listing_section_shortcode');

/**
 * Add editor styles
 */
function amt_spice_add_editor_styles() {
    add_editor_style('editor-style.css');
    add_editor_style(get_template_directory_uri() . '/assets/css/editor.css');
}
add_action('admin_init', 'amt_spice_add_editor_styles');