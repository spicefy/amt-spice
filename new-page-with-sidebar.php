<?php
/**
 * Template Name: New Page with Sidebar
 * Template Post Type: page
 */
get_template_part('template-parts/header');
?>

<main class="container mt-5">
    <div class="row">
        
        <!-- Hero Section -->
        <section style="background: linear-gradient(135deg, <?php echo esc_attr(get_theme_mod('amt_page_header_bg', '#009bbe')); ?>, #0061ff);" class="text-start p-5 text-white">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-6 text-start">
                        <?php the_title('<h1 class="display-4 mb-4">', '</h1>'); ?>
                    </div>
                    <div class="col-md-6 position-static">
                        <div style="position: absolute; bottom: 0px; right: 20px; max-width: 350px;">
                            <?php
                            // Use Featured Image if set, otherwise fallback to theme mod
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', ['class' => 'img-fluid rounded']);
                            } else {
                                $default_image = get_theme_mod(
                                    'amt_page_header_image',
                                    get_template_directory_uri() . '/assets/images/default-header.jpg'
                                );
                                echo '<img src="' . esc_url($default_image) . '" class="img-fluid rounded" alt="' . esc_attr(get_the_title()) . '">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Sidebar Section -->
        <aside class="col-lg-4 order-1 order-lg-2 mt-3 text-start">
            <div class="p-3 border rounded">
                <h2 class="fw-bold mb-3">
                    <?php
                    // Get sidebar title from custom field or default
                    $sidebar_title = get_post_meta(get_the_ID(), '_sidebar_title', true);
                    echo $sidebar_title ? esc_html($sidebar_title) : esc_html(get_theme_mod('amt_default_sidebar_title', 'About Us'));
                    ?>
                </h2>
                
                <?php wp_nav_menu(array(
                    'theme_location' => 'sidebar-menu',
                    'menu_class'     => 'list-unstyled',
                    'container'      => false,
                    'depth'          => 1,
                    'walker'         => new WP_Bootstrap_Navwalker(),
                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback'
                )); ?>
            </div>
        </aside>

        <!-- Main Content Section -->
        <div class="col-lg-8 order-2 order-lg-1 text-start">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>
<?php wp_footer(); ?>