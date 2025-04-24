<?php
/**
 * Template part for displaying testimonials section.
 *
 * @package YourThemeName
 */

// Retrieve testimonials section settings from Customizer
$testimonials_title = get_theme_mod('amt_testimonials_title', 'Testimonials');
$testimonials_text = get_theme_mod('amt_testimonials_text', 'Visit our website lovemattersafrica.com today.');
$testimonials_button_text = get_theme_mod('amt_testimonials_button_text', 'Learn More');
$testimonials_button_link = get_theme_mod('amt_testimonials_button_link', '#');

// Retrieve testimonials from Customizer
$testimonials_data = get_theme_mod('amt_testimonials_data', json_encode([]));
$testimonials = json_decode($testimonials_data, true);
?>

<!-- Testimonials Slideshow -->
<section class="bg-light text-center p-5">
    <?php if ($testimonials_title) : ?>
        <h2><?php echo esc_html($testimonials_title); ?></h2>
    <?php endif; ?>

    <!-- Testimonial Carousel -->
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($testimonials as $index => $testimonial) : ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <blockquote class="blockquote">
                        <p>"<?php echo esc_html($testimonial['text']); ?>"</p>
                        <footer class="blockquote-footer"><?php echo esc_html($testimonial['author']); ?></footer>
                    </blockquote>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Call to Action -->
    <?php if ($testimonials_text) : ?>
        <p class="mt-4"><?php echo esc_html($testimonials_text); ?></p>
    <?php endif; ?>
    
    <?php if ($testimonials_button_link) : ?>
        <a href="<?php echo esc_url($testimonials_button_link); ?>" class="btn btn-outline-primary"> 
            <?php echo esc_html($testimonials_button_text); ?>
        </a>
    <?php endif; ?>
</section>