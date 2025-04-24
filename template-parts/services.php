<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit('Direct access not allowed.');
}

// Load WordPress environment if needed
if (!function_exists('get_theme_mod')) {
    require_once dirname(__FILE__) . '/../../../../wp-load.php';
}

$services_title = get_theme_mod('amt_services_title', 'Our Services');
?>

<section class="container my-5 text-center">
    <?php if (!empty($services_title)) : ?>
        <h2 class="mb-5"><?php echo esc_html($services_title); ?></h2>
    <?php endif; ?>

    <div class="row">
        <?php for ($i = 1; $i <= 4; $i++) : 
            $service_title = get_theme_mod("amt_service_title_$i", "Service $i");
            $service_text  = get_theme_mod("amt_service_text_$i", "Description for Service $i");
            $service_link  = get_theme_mod("amt_service_link_$i", '#');

            // Ensure a valid URL
            if (!$service_link || !filter_var($service_link, FILTER_VALIDATE_URL)) {
                $service_link = '#';
            }

            if (!empty($service_title)) : ?>
                <div class="col-md-3">
                    <h4><?php echo esc_html($service_title); ?></h4>
                    <?php if (!empty($service_text)) : ?>
                        <p><?php echo esc_html($service_text); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($service_link); ?>" class="btn btn-outline-secondary">
                        <?php esc_html_e('Learn More', 'amt-spice'); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</section>
