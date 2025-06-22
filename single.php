<?php get_template_part('template-parts/header'); // Load custom headerget_header(); 

?>

<main id="primary" class="site-main container text-start py-5">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
            
            <header class="entry-header mb-4">
            <?php custom_breadcrumbs(); ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <div class="entry-meta text-muted mb-3">
                    Posted on <?php the_time('F j, Y'); ?> by <?php the_author(); ?> |
                    Categories: <?php the_category(', '); ?>
                </div>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="jarallax mb-lg-5 mb-4" data-jarallax data-speed="0.35" style="height: 36.45vw; min-height: 300px;">
    <div class="jarallax-img" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');"></div>
</div>
                <?php endif; ?>
            </header>

            <div class="entry-content">
                <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">Pages:',
                        'after'  => '</div>',
                    ));
                ?>
            </div>


            

            <div class="mt-5">
            <?php
$tags = get_the_tags();
if ($tags): ?>
  <div class="d-flex flex-sm-row flex-column pt-2">
    <h6 class="mt-sm-1 mb-sm-2 mb-3 me-2 text-nowrap">Related Tags:</h6>
    <div>
      <?php foreach ($tags as $tag): ?>
        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="btn btn-sm btn-outline-secondary me-2 mb-2">
          #<?php echo esc_html($tag->name); ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

                <div class="post-navigation d-flex justify-content-between mt-5">
                    <div class="prev-post">
                        <?php previous_post_link('%link', '← %title'); ?>
                    </div>
                    <div class="next-post">
                        <?php next_post_link('%link', '%title →'); ?>
                    </div>
                </div>
      </div>

        </article>

        <?php
            // Related Posts Section
            $categories = get_the_category();
            if ( $categories ) :
                $category_ids = array();

                foreach( $categories as $category ) {
                    $category_ids[] = $category->term_id;
                }

                $related_query = new WP_Query( array(
                    'category__in'   => $category_ids,
                    'post__not_in'   => array( get_the_ID() ),
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1,
                ) );

                if ( $related_query->have_posts() ) : ?>
                    
                    <section class="related-posts mt-5">
                    <div class="d-flex flex-sm-row flex-column align-items-center justify-content-between mb-4 pb-1 pb-md-3">
          <h2 class="h1 mb-sm-0">Related Articles</h2>
          <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-lg btn-outline-primary ms-4">
  All posts
  <i class="bx bx-right-arrow-alt ms-1 me-n1 lh-1 lead"></i>
</a>
        </div>
        
                        <div class="row">
                            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
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
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </section>

                <?php endif;

                wp_reset_postdata();
            endif;
        ?>

        <?php
            // If comments are open or there are comments, load comments template
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>

    <?php endwhile; else : ?>

        <div class="no-post-found text-center">
            <h2>No Post Found</h2>
            <p>It looks like we can't find the post you are looking for.</p>
        </div>

    <?php endif; ?>

</main>

<?php get_template_part('template-parts/footer'); ?>