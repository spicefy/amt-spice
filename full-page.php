<?php
/**
 * Template Name: full page
 * Template Post Type: page
 */
get_template_part('template-parts/header');
?>


<main class="container mt-5">
 
        

        <!-- Main Content - Bottom on mobile, Left on desktop -->
       
            <?php
            while (have_posts()) : the_post();
                the_title('<h1 class="display-4 mb-4 text-start">', '</h1>');
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>
<?php wp_footer(); ?>