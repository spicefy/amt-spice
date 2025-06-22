<?php
$intro_title = get_theme_mod('amt_intro_title', 'Who We Are.');
$intro_text = get_theme_mod('amt_intro_text', 'We are a team of SRHR, public health, LGBT, and media experts who together contribute to a thriving and engaging online experience for young people seeking information on health and linkages to services. Referrals are made through the impressive engagements on our social media platforms or through the clinic locator on our website.');
$intro_button_text = get_theme_mod('amt_intro_button_text', 'Learn More');
$intro_button_link = get_theme_mod('amt_intro_button_link', '#');
$intro_image = get_theme_mod('amt_intro_image');
?>

<section style="background: linear-gradient(250deg, #fd153a, #009bbe);" class="text-white text-start p-4">
    <div class="container">
        <div class="row align-items-center">
            <!-- TEXT FIRST -->
            <div class="<?php echo $intro_image ? 'col-md-6 text-start' : 'col-md-12'; ?>">
                <h2 class="text-white"><?php echo esc_html($intro_title); ?></h2>
                <p class="text-white"><?php echo esc_html($intro_text); ?></p>
                <a href="<?php echo esc_url($intro_button_link); ?>" class="btn btn-light btn-lg btn-wide text-decoration-none mb-3 hover-icon-slide">
                    <?php echo esc_html($intro_button_text); ?>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- IMAGE SECOND -->
            <?php if ($intro_image) : ?>
                <div class="col-md-6">
                    <img src="<?php echo esc_url($intro_image); ?>" alt="<?php echo esc_attr($intro_title); ?>" class="img-fluid rounded">
                </div>
            <?php endif; ?>
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

.text-white h2 {
    font-weight: 800;
    font-size: 2.8rem;
    color: #0e8e37;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}

.text-white h2::after {
    content: '';
    display: block;
    width: 80px;
    height: 5px;
    background: #fd153a;
    margin-top: 15px;
}
</style>