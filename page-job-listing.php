<?php
/**
 * Template Name: Job Listing / Vacancies Page
 * Theme: amt-spice
 */

get_template_part('template-parts/header');
?>
<?php custom_breadcrumbs(); ?>

<?php
// Shortcode support, or fallback to template part
if ( shortcode_exists('jobs_listing_section') ) {
    echo do_shortcode('[jobs_listing_section]');
} else {
    get_template_part('template-parts/jobs-listing-section');
}
?>

<?php
get_template_part('template-parts/footer'); ?>