<?php
/**
 * Template Name: Blog Page
 */
get_template_part('template-parts/header'); ?>

<div class="blog-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <div class="post">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>">Read more</a>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>No posts found</p>';
    endif;
    ?>


<?php
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('Previous', 'textdomain'),
        'next_text' => __('Next', 'textdomain'),
    ));
?>
</div>

<?php 

get_template_part('template-parts/footer'); 
get_footer(); ?>
