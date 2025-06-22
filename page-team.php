<?php
/**
 * Template Name: Team Page
 *
 * @package amt-spice
 */

get_template_part('template-parts/header');
?>
<?php custom_breadcrumbs(); ?>


<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // Display sponsors section
      
// Shortcode support, or fallback to template part
if ( shortcode_exists('sponsors_section') ) {
    echo do_shortcode('[sponsors_section]');
} else {
    get_template_part('template-parts/sponsors-section');
}


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_template_part('template-parts/footer'); ?>