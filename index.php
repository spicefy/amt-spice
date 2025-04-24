<?php
/**
 * The main template file
 */

get_template_part('template-parts/header'); // Load custom header
?>

<main id="primary" class="site-main">
    <?php
    // Hero Section
    get_template_part('template-parts/hero-section');
    
    // Intro Section
    get_template_part('template-parts/intro-section');
    
    
    // Services Section
    get_template_part('template-parts/services');

    // Chat Support Section
    get_template_part('template-parts/chat-support');
    
    
    // Testimonials Section
    get_template_part('template-parts/testimonials');
    
    // Blog posts
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_type());
        endwhile;
        
        the_posts_navigation();
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main>

<?php get_template_part('template-parts/footer'); ?>

<?php wp_footer(); ?>
