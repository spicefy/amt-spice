<?php


get_template_part('template-parts/header');
?>

<main id="primary" class="site-main container text-start py-5">
<div class="row">
    <div class="col-xl-9 col-lg-8">

    <div class="container my-4">
    <div class="row align-items-end gy-3 mb-4 pb-lg-3 pb-1">
        <div class="col-lg-5 col-md-4">
            <h1 class="mb-2 mb-md-0"><?php
                if (is_home() && !is_front_page()) {
                    // If it's the blog index page, show a custom title
                    echo 'Blog List';
                } elseif (is_category()) {
                    // If it's a category page, display the category name
                    single_cat_title();
                } elseif (is_search()) {
                    // If it's a search results page, display 'Search Results'
                    echo 'Search Results for: ' . get_search_query();
                } else {
                    // Otherwise, display the title of the current page
                    the_title();
                }
                ?></h1>
        </div>
        <div class="col-lg-7 col-md-8">
            <div class="row gy-2">
                <!-- Category Dropdown -->
                <div class="col-lg-5 col-sm-6">
                    <div class="d-flex align-items-center">
                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <select name="category_name" class="form-select">
                                <option value=""><?php _e('All categories', 'textdomain'); ?></option>
                                <?php
                                $categories = get_categories();
                                foreach ($categories as $category) : ?>
                                    <option value="<?php echo esc_attr($category->slug); ?>" <?php selected(get_query_var('category_name'), $category->slug); ?>><?php echo esc_html($category->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                </div>
                <!-- Search Bar -->
                <div class="col-lg-7 col-sm-6">
                    <div class="input-group">
                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" name="s" class="form-control pe-5 rounded" placeholder="Search the blog..." value="<?php echo get_search_query(); ?>">
                            <i class="bx bx-search position-absolute top-50 end-0 translate-middle-y me-3 zindex-5 fs-lg"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $posts_per_page = 6;

    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'post_status'    => 'publish',
    );

    $query = new WP_Query($args);

    if ( $query->have_posts() ) : ?>
        <div class="row" id="posts-container">
            <?php
            $post_count = 0;

            while ( $query->have_posts() ) : $query->the_post();
                $post_count++;

                // Highlight the first post on the first page
                if ( $post_count == 1 && $paged == 1 ) : ?>
                    <div class="col-12 mb-5">
                        <div class="featured-post card shadow-sm p-4">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-6">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="featured-content">
                                        <span class="text-uppercase text-primary small">Featured</span>
                                        <h2 class="h3 mt-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <p class="text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                                        <p class="small text-muted">
                                            <?php echo get_the_date(); ?> | <?php echo amt_spice_estimated_reading_time(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <small class="text-muted d-block mb-1"><?php the_category(', '); ?></small>
                                <h5 class="card-title h6">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>
                                <p class="card-text small text-muted">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 text-muted small">
                                <?php echo get_the_date(); ?> | <?php echo amt_spice_estimated_reading_time(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>

        <div class="text-center mt-5">

    <?php
    $total_posts = $query->found_posts;
    $start_post = ($paged - 1) * $posts_per_page + 1;
    $end_post = min($start_post + $posts_per_page - 1, $total_posts);
    ?>

    <p class="text-muted mb-3">
        Showing <?php echo $start_post; ?>–<?php echo $end_post; ?> of <?php echo $total_posts; ?> posts
    </p>

    <nav aria-label="Posts navigation">
        <ul class="pagination justify-content-center">

            <?php if ($paged > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo get_pagenum_link($paged - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php
            $max_pages = $query->max_num_pages;
            for ($i = 1; $i <= $max_pages; $i++) :
                $active = ($paged == $i) ? 'active' : '';
                ?>
                <li class="page-item <?php echo $active; ?>">
                    <a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($paged < $max_pages) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo get_pagenum_link($paged + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

</div>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <div class="no-post-found text-center">
            <h2>No Posts Found</h2>
            <p>There are no posts yet. Please check back later.</p>
        </div>
    <?php endif; ?>


    </div>

    <aside class="col-xl-3 col-lg-4">
  <div class="offcanvas-lg offcanvas-end" id="blog-sidebar" tabindex="-1">

    <!-- Sidebar Header (for offcanvas view) -->
    <div class="offcanvas-header border-bottom">
      <h3 class="offcanvas-title fs-lg">Sidebar</h3>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#blog-sidebar" aria-label="Close"></button>
    </div>

    <!-- Sidebar Body -->
    <div class="offcanvas-body">
      <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'blog-sidebar' ); ?>
      <?php else : ?>
        <!-- Fallback content if no widgets are active -->
        <div class="card card-body">
          <p>Add widgets to the <strong>Blog Sidebar</strong> area in WordPress admin.</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</aside>
      </div>
</main>

<?php get_template_part('template-parts/footer'); ?>
