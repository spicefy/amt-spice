<?php
/* Template Name: Our team */
get_template_part('template-parts/header');
?>
<?php custom_breadcrumbs(); ?>
<?php echo do_shortcode('[team_members]'); ?>

<?php
// Shortcode support, or fallback to template part
if ( shortcode_exists('sponsors_section') ) {
    echo do_shortcode('[sponsors_section]');
} else {
    get_template_part('template-parts/team-section');
}
     ?>
<?php get_template_part('template-parts/footer'); ?>