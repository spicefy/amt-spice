<?php
/**
 * Template Name: Page with Sidebar
 * Template Post Type: page
 */
get_template_part('template-parts/header');
?>

<main class="container mt-5">
    <div class="row">
        
        <!-- About Us Section -->
        <section style="background: linear-gradient(135deg, <?php echo esc_attr( get_theme_mod( 'amt_about_us_bg_color', '#009bbe' ) ); ?>, #0061ff); position: relative;" class="text-start p-5 text-white">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-6 text-start"> <!-- Ensure the text is aligned left -->
                        <?php the_title('<h1 class="display-4 mb-4">', '</h1>'); ?>
                    </div>
                    <div class="col-md-6 position-static">
                        <!-- Image positioned absolutely within the section -->
                        <div style="position: absolute; bottom: 0px; right: 20px; max-width: 350px;">
                            <img src="<?php echo esc_url( get_theme_mod( 'amt_about_us_image', get_template_directory_uri() . '/assets/images/about.png' ) ); ?>" alt="Chat Support" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Sidebar Section -->
        <aside class="col-lg-4 order-1 order-lg-2 mt-3 text-start"> <!-- Ensure sidebar text is aligned left -->
            <div class="p-3 border rounded">
                <h2 class="fw-bold mb-3"><?php echo esc_html( get_theme_mod( 'amt_sidebar_title', 'About Us' ) ); ?></h2>
                
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

        <!-- Main Content Section added text-start -->
        <div class="col-lg-8 order-2 order-lg-1 text-start">
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
