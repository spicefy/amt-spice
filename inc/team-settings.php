<?php
/**
 * Sponsors / Team Members Custom Post Type and Metaboxes
 * Integrates with WP Admin for adding/editing team members.
 * Theme: amt-spice
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Register Custom Post Type: Team Member (Sponsor)
function amt_spice_register_team_member_cpt() {
    $labels = array(
        'name'                  => _x( 'Team Members', 'Post Type General Name', 'amt-spice' ),
        'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'amt-spice' ),
        'menu_name'             => __( 'Team Members', 'amt-spice' ),
        'name_admin_bar'        => __( 'Team Member', 'amt-spice' ),
        'add_new_item'          => __( 'Add New Member', 'amt-spice' ),
        'edit_item'             => __( 'Edit Team Member', 'amt-spice' ),
        'view_item'             => __( 'View Team Member', 'amt-spice' ),
        'all_items'             => __( 'All Members', 'amt-spice' ),
        'search_items'          => __( 'Search Members', 'amt-spice' ),
    );
    $args = array(
        'label'                 => __( 'Team Member', 'amt-spice' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-groups',
        'has_archive'           => false,
        'rewrite'               => false,
        'show_in_rest'          => true,
    );
    register_post_type( 'team_member', $args );
}
add_action( 'init', 'amt_spice_register_team_member_cpt' );

// Add metaboxes for extra member data
function amt_spice_team_member_meta_boxes() {
    add_meta_box(
        'team_member_details',
        __( 'Member Details', 'amt-spice' ),
        'amt_spice_team_member_meta_box_callback',
        'team_member',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'amt_spice_team_member_meta_boxes' );

function amt_spice_team_member_meta_box_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'amt_spice_team_member_nonce' );
    $position = get_post_meta( $post->ID, '_team_member_position', true );
    $socials = get_post_meta( $post->ID, '_team_member_socials', true );
    $socials = is_array($socials) ? $socials : array();

    ?>
    <p>
        <label for="team_member_position"><?php _e( 'Position Title:', 'amt-spice' ); ?></label><br>
        <input type="text" id="team_member_position" name="team_member_position" value="<?php echo esc_attr($position); ?>" style="width:100%;">
    </p>
    <p><strong><?php _e('Social Links (fill only those needed):', 'amt-spice'); ?></strong></p>
    <?php
        $social_fields = array(
            'twitter'   => 'Twitter URL',
            'facebook'  => 'Facebook URL',
            'linkedin'  => 'LinkedIn URL',
            'instagram' => 'Instagram URL',
            'github'    => 'GitHub URL',
            'dribbble'  => 'Dribbble URL',
            'behance'   => 'Behance URL',
            'youtube'   => 'YouTube URL'
        );
        foreach ($social_fields as $key => $label) {
            ?>
            <label for="team_member_socials_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label><br>
            <input type="url" id="team_member_socials_<?php echo esc_attr($key); ?>" name="team_member_socials[<?php echo esc_attr($key); ?>]" value="<?php echo esc_url( isset($socials[$key]) ? $socials[$key] : '' ); ?>" style="width:100%; margin-bottom:10px;"><br>
            <?php
        }
    ?>
    <?php
}

function amt_spice_team_member_save_meta( $post_id ) {
    if ( !isset( $_POST['amt_spice_team_member_nonce'] ) || !wp_verify_nonce( $_POST['amt_spice_team_member_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    if ( 'team_member' != $_POST['post_type'] ) return $post_id;

    // Save Position
    $position = sanitize_text_field( $_POST['team_member_position'] );
    update_post_meta( $post_id, '_team_member_position', $position );

    // Save Social links
    $socials = array();
    if ( isset( $_POST['team_member_socials'] ) && is_array($_POST['team_member_socials']) ) {
        foreach ($_POST['team_member_socials'] as $key => $url) {
            if ($url) {
                $socials[$key] = esc_url_raw($url);
            }
        }
    }
    update_post_meta( $post_id, '_team_member_socials', $socials );
}
add_action( 'save_post', 'amt_spice_team_member_save_meta' );