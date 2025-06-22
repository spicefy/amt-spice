<?php
/**
 * Job Listings Custom Post Type and Metaboxes
 * Theme: amt-spice
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Register Custom Post Type: Job
function amt_spice_register_job_cpt() {
    $labels = array(
        'name'                  => _x( 'Jobs', 'Post Type General Name', 'amt-spice' ),
        'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'amt-spice' ),
        'menu_name'             => __( 'Jobs', 'amt-spice' ),
        'name_admin_bar'        => __( 'Job', 'amt-spice' ),
        'add_new_item'          => __( 'Add Job Vacancy', 'amt-spice' ),
        'edit_item'             => __( 'Edit Job', 'amt-spice' ),
        'view_item'             => __( 'View Job', 'amt-spice' ),
        'all_items'             => __( 'All Jobs', 'amt-spice' ),
        'search_items'          => __( 'Search Jobs', 'amt-spice' ),
    );
    $args = array(
        'label'                 => __( 'Job', 'amt-spice' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-businessman',
        'has_archive'           => false,
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'job'),
    );
    register_post_type( 'job', $args );
}
add_action( 'init', 'amt_spice_register_job_cpt' );

// Add metaboxes for extra job data (no "status" field anymore)
function amt_spice_job_meta_boxes() {
    add_meta_box(
        'job_details',
        __( 'Job Details', 'amt-spice' ),
        'amt_spice_job_meta_box_callback',
        'job',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'amt_spice_job_meta_boxes' );

function amt_spice_job_meta_box_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'amt_spice_job_nonce' );
    $company = get_post_meta( $post->ID, '_job_company', true );
    $location = get_post_meta( $post->ID, '_job_location', true );
    $closing_date = get_post_meta( $post->ID, '_job_closing_date', true );
    $apply_url = get_post_meta( $post->ID, '_job_apply_url', true );
    $skills = get_post_meta( $post->ID, '_job_skills', true );
    ?>
    <p>
        <label for="job_company"><?php _e( 'Company Name:', 'amt-spice' ); ?></label><br>
        <input type="text" id="job_company" name="job_company" value="<?php echo esc_attr($company); ?>" style="width:100%;">
    </p>
    <p>
        <label for="job_location"><?php _e( 'Location:', 'amt-spice' ); ?></label><br>
        <input type="text" id="job_location" name="job_location" value="<?php echo esc_attr($location); ?>" style="width:100%;">
        <small><?php _e( 'e.g. Remote, On-site, Hybrid, City, etc.', 'amt-spice' ); ?></small>
    </p>
    <p>
        <label for="job_closing_date"><?php _e( 'Closing Date:', 'amt-spice' ); ?></label><br>
        <input type="date" id="job_closing_date" name="job_closing_date" value="<?php echo esc_attr($closing_date); ?>" style="width:100%;">
        <small><?php _e( 'Deadline for applications.', 'amt-spice' ); ?></small>
    </p>
    <p>
        <label for="job_apply_url"><?php _e( 'Apply Link (URL):', 'amt-spice' ); ?></label><br>
        <input type="url" id="job_apply_url" name="job_apply_url" value="<?php echo esc_url($apply_url); ?>" style="width:100%;">
        <small><?php _e( 'Will be shown in "How to Apply" section.', 'amt-spice' ); ?></small>
    </p>
    <p>
        <label for="job_skills"><?php _e( 'Skills (comma separated):', 'amt-spice' ); ?></label><br>
        <input type="text" id="job_skills" name="job_skills" value="<?php echo esc_attr($skills); ?>" style="width:100%;">
        <small><?php _e( 'e.g. React, TypeScript, CSS', 'amt-spice' ); ?></small>
    </p>
    <?php
}

function amt_spice_job_save_meta( $post_id ) {
    if ( !isset( $_POST['amt_spice_job_nonce'] ) || !wp_verify_nonce( $_POST['amt_spice_job_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    if ( 'job' != $_POST['post_type'] ) return $post_id;

    update_post_meta( $post_id, '_job_company', sanitize_text_field( $_POST['job_company'] ) );
    update_post_meta( $post_id, '_job_location', sanitize_text_field( $_POST['job_location'] ) );
    update_post_meta( $post_id, '_job_closing_date', sanitize_text_field( $_POST['job_closing_date'] ) );
    update_post_meta( $post_id, '_job_apply_url', esc_url_raw( $_POST['job_apply_url'] ) );
    update_post_meta( $post_id, '_job_skills', sanitize_text_field( $_POST['job_skills'] ) );
}
add_action( 'save_post', 'amt_spice_job_save_meta' );