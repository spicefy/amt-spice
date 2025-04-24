<?php
$intro_title = get_theme_mod('amt_intro_title', 'Blush-free facts and stories about love, sex, and relationships.');
$intro_text = get_theme_mod('amt_intro_text', 'Learn more about Blush-free facts and stories about love, sex, and relationships');
$intro_button_text = get_theme_mod('amt_intro_button_text', 'Learn More');
$intro_button_link = get_theme_mod('amt_intro_button_link', '#');
$intro_image = get_theme_mod('amt_intro_image');
?>

<section style="background-color: var(--primary-color);" class="text-white text-center p-4">
    <div class="container">
        <div class="row align-items-center">
            <?php if ($intro_image) : ?>
                <div class="col-md-6">
                    <img src="<?php echo esc_url($intro_image); ?>" alt="<?php echo esc_attr($intro_title); ?>" class="img-fluid rounded">
                </div>
            <?php endif; ?>
            
            <div class="<?php echo $intro_image ? 'col-md-6' : 'col-md-12'; ?>">
                <h2><?php echo esc_html($intro_title); ?></h2>
                <p><?php echo esc_html($intro_text); ?></p>
                <a href="<?php echo esc_url($intro_button_link); ?>" class="btn btn-light"><?php echo esc_html($intro_button_text); ?></a>
            </div>
        </div>
    </div>
</section>