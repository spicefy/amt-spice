<?php
$hero_title = get_theme_mod('amt_hero_title', 'Book us today');
$hero_text = get_theme_mod('amt_hero_text', 'Get blush-free facts and stories about love, sex, and relationships.');
$hero_button_text = get_theme_mod('amt_hero_button_text', 'Get Started');
$hero_button_link = get_theme_mod('amt_hero_button_link', '#');
$hero_background = get_theme_mod('amt_hero_background');
?>

<section class="hero-section text-left" <?php if ($hero_background) echo 'style="background-image: url(' . esc_url($hero_background) . ')"'; ?>>
    <div class="container">
        <div class="hero-content">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_text); ?></p>
            <a href="<?php echo esc_url($hero_button_link); ?>" class="btn btn-primary"><?php echo esc_html($hero_button_text); ?></a>
        </div>
    </div>
</section>