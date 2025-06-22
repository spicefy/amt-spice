<?php get_template_part('template-parts/header'); // Load custom headerget_header(); 

?>

<main id="primary" class="site-main container ">
<?php custom_breadcrumbs(); ?>
    <header class="archive-header text-center mb-5">
        <?php if ( is_category() ) : ?>
            <h1 class="archive-title">Category: <?php single_cat_title(); ?></h1>
        <?php elseif ( is_tag() ) : ?>
            <h1 class="archive-title">Tag: <?php single_tag_title(); ?></h1>
        <?php elseif ( is_author() ) : ?>
            <h1 class="archive-title">Author: <?php the_author(); ?></h1>
        <?php elseif ( is_year() ) : ?>
            <h1 class="archive-title">Year: <?php the_time('Y'); ?></h1>
        <?php elseif ( is_month() ) : ?>
            <h1 class="archive-title">Month: <?php the_time('F Y'); ?></h1>
        <?php elseif ( is_day() ) : ?>
            <h1 class="archive-title">Day: <?php the_time('F j, Y'); ?></h1>
        <?php else : ?>
            <h1 class="archive-title">Archives</h1>
        <?php endif; ?>

        <?php if ( term_description() ) : ?>
            <div class="archive-description text-muted mt-3">
                <?php echo term_description(); ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>

        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title h6">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text small text-muted">
                                <?php echo wp_trim_words( get_the_excerpt(), 15 ); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-center mb-3">
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination-wrapper mt-5">
            <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __('« Prev', 'textdomain'),
                    'next_text' => __('Next »', 'textdomain'),
                ) );
            ?>
        </div>

    <?php else : ?>

        <div class="no-post-found text-center">
            <h2>No Posts Found</h2>
            <p>There are no posts under this archive yet.</p>
        </div>

    <?php endif; ?>

</main>

<?php get_template_part('template-parts/footer'); ?>