<?php
/**
 * Template Name: Page with Sidebar no image
 * Template Post Type: page
 */
get_template_part('template-parts/header');
?>


<main class="container mt-5">
    <div class="row">
        <!-- Sidebar - Top on mobile, Right on desktop -->
        <aside class="col-lg-4 order-1 order-lg-2 mt-3">
            <div class="p-3 border rounded">
                <h2 class="fw-bold mb-3"><?php esc_html_e('About Us', 'amt-spice'); ?></h2>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'sidebar-menu',
                    'menu_class'     => 'list-unstyled',
                    'container'      => false,
                    'depth'          => 1,
                    'walker'         => new WP_Bootstrap_Navwalker(),
                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback'
                ));
                ?>
            </div>
        </aside>

        <!-- Main Content - Bottom on mobile, Left on desktop -->
        <div class="col-lg-8 order-2 order-lg-1"> <!-- Changed order classes -->
            <?php
            while (have_posts()) : the_post();
                the_title('<h1 class="display-4 mb-4">', '</h1>');
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>
<?php wp_footer(); ?>