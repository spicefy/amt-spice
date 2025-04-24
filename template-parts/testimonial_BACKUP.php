<?php
$testimonials_title = get_theme_mod('amt_testimonials_title', 'Testimonials Get Blush-free facts and stories about love, sex, and relationships');
$testimonials_text = get_theme_mod('amt_testimonials_text', 'Visit our website lovemattersafrica.com today.');
$testimonials_button_text = get_theme_mod('amt_testimonials_button_text', 'Learn More');
$testimonials_button_link = get_theme_mod('amt_testimonials_button_link', '#');
?>

<section class="bg-light text-center p-5">
    <?php if ($testimonials_title) : ?>
        <h2><?php echo esc_html($testimonials_title); ?></h2>
    <?php endif; ?>
    
    <?php if ($testimonials_text) : ?>
        <p><?php echo esc_html($testimonials_text); ?></p>
    <?php endif; ?>
    
    <?php if ($testimonials_button_link) : ?>
        <a href="<?php echo esc_url($testimonials_button_link); ?>" class="btn btn-outline-primary"><?php echo esc_html($testimonials_button_text); ?></a>
    <?php endif; ?>
</section>