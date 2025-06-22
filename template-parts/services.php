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

<section class="bg-secondary p-4">
    <div class="container">
        <?php if (!empty($services_title)) : ?>
            <h2 class="mb-5 text-start"><?php echo esc_html($services_title); ?></h2>
        <?php endif; ?>

        <div class="row">
            <?php for ($i = 1; $i <= 4; $i++) : 
                $service_title = get_theme_mod("amt_service_title_$i", "Service $i");
                $service_text  = get_theme_mod("amt_service_text_$i", "Description for Service $i");
                $service_link  = get_theme_mod("amt_service_link_$i", '#');

                // Ensure a valid URL only if link is not '#'
                if ($service_link !== '#' && !filter_var($service_link, FILTER_VALIDATE_URL)) {
                    $service_link = '#';
                }

                if (!empty($service_title)) : ?>
                    <div class="col-md-3 mb-4">
                        <h4><?php echo esc_html($service_title); ?></h4>
                        <?php if (!empty($service_text)) : ?>
                            <p><?php echo esc_html($service_text); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($service_link); ?>" class="btn btn-outline-secondary btn-lg btn-wide text-decoration-none rounded-pill hover-icon-slide">
                            <?php esc_html_e('Learn More', 'amt-spice'); ?>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<style>
.hover-icon-slide i {
    transition: transform 0.3s ease;
    display: inline-block;
}

.hover-icon-slide:hover i {
    transform: translateX(5px);
}

.mb-5 {
    margin-bottom: 3rem!important;
}
.mb-5 h2,
h2.mb-5 {
    font-weight: 800;
    font-size: 2.8rem;
    color:var(--primary-color);
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}
.mb-5 h2::after,
h2.mb-5::after {
    content: '';
    display: block;
    width: 80px;
    height: 5px;
    background:var(--secondary-color);
    margin-top: 15px;
}
</style>