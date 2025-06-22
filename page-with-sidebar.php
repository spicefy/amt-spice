<?php
/**
 * Template Name: Page with Sidebar
 * Template Post Type: page
 */
get_template_part('template-parts/header');
?>



    <?php custom_breadcrumbs(); ?>
    <!-- Page title -->
<style>
  .custom-page-header-inner {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.custom-header-content {
    flex: 1 1 300px;

}
.custom-header-content h1 {
    color: inherit !important;
}

.custom-header-image {
    flex: 1 1 300px;
    text-align: right;
}

.custom-header-image img {
    max-height: 300px;
    width: auto;
    height: auto;
    max-width: 100%;
    border-radius: 8px;
}

@media (max-width: 768px) {
    .custom-page-header-inner {
        flex-direction: column;
        text-align: center;
    }

    .custom-header-image {
        text-align: center;
    }
    .imgtop{
      max-height: 100% !important;
    }
    .imgtoptext{
      z-index:10
    }
}
</style>
<?php
$bg_color = get_theme_mod('page_header_bg_color', '#2c3e50');
$text_color = get_theme_mod('page_header_text_color', '#ffffff');
$padding = get_theme_mod('page_header_padding', '40px');
$image_max_height = get_theme_mod('page_header_image_max_height', '300px');
?>
<section style="background: linear-gradient(135deg, #009bbe, #0061ff); position: relative;" class="text-start p-5 text-white">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-6 text-start d-flex align-items-center">
                <h1 class="display-4 mb-4 imgtoptext" style="color: <?php echo esc_attr($text_color); ?>;"><?php the_title(); ?></h1>
            </div>
            <div class="col-md-6 position-static">
                <?php if ( has_post_thumbnail() ) : 
                    $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    ?>
                    <div style="position: absolute; bottom: 0px; right: 20px; max-width: 350px;" class="imgtop">
                        <noscript>
                            <img 
                                src="<?php echo esc_url( $image_url ); ?>" 
                                alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                class="img-fluid rounded">
                        </noscript>
                        <img 
                            decoding="async" 
                            src="<?php echo esc_url( $image_url ); ?>" 
                            data-src="<?php echo esc_url( $image_url ); ?>" 
                            alt="<?php echo esc_attr( get_the_title() ); ?>" 
                            class="lazy img-fluid rounded">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


    

<main class="container py- my-1 my-md-4 my-lg-4">
    <div class="row">
        
        <!-- About Us Section -->
        
        
        <!-- Sidebar Section -->
        
<aside class="col-lg-4 col-md-5 offset-xl-1 order-md-2 mb-5">
            <div style="margin-top: -96px;"></div>
            <div class="position-sticky top-0 pt-5">
              <div class="pt-5 mt-md-3">
                <div class="card shadow-sm p-sm-3">
                  <div class="card-body">
                    <h4 class="mb-4"><?php echo esc_html( get_theme_mod( 'amt_sidebar_title', 'About Us' ) ); ?></h4>
                    <?php
                wp_nav_menu(array(
                    'theme_location' => 'sidebar-menu',
                    'menu_class'     => 'list-unstyled menupage',
                    'container'      => false,
                    'depth'          => 1,
                    'walker'         => new WP_Bootstrap_Navwalker(),
                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback'
                ));
                ?>
                    
                  </div>
                </div>
              </div>
            </div>
          </aside>





        <!-- Main Content Section added text-start -->
        <div class="col-xl-7 col-lg-8 col-md-7 order-md-1 mb-5">
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
