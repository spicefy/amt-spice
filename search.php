<?php
get_template_part('template-parts/header'); // Include the header template.

if (have_posts()) : ?>
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
                <div class="col-lg-4 col-sm-6">
                    <div class="d-flex align-items-center">
                        <form method="get"  class="w-100" action="<?php echo esc_url(home_url('/')); ?>">
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
                <div class="col-lg-8 col-sm-6">
                    <div class="input-group">
                        <form method="get" class="w-100" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" name="s" class="form-control pe-5 rounded" placeholder="Search the blog..." value="<?php echo get_search_query(); ?>">
                            <i class="bx bx-search position-absolute top-50 end-0 translate-middle-y me-3 zindex-5 fs-lg"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

       
        <div class="row">
            <?php
            // Loop through the search results.
            while (have_posts()) : the_post(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
      

       
    </div>

    <!-- Categories -->
    <div class="container my-4">
        <h3>Categories</h3>
        <div class="row">
            <?php
            $categories = get_categories();
            if ($categories) {
                foreach ($categories as $category) : ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc_html($category->name); ?></h5>
                                <p class="card-text"><?php echo esc_html($category->description); ?></p>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="btn btn-secondary">View Posts</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } else {
                echo '<p>No categories found.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Tags -->
    <div class="container my-4">
        <h3>Tags</h3>
        <div class="row">
            <?php
            $tags = get_tags();
            if ($tags) {
                foreach ($tags as $tag) : ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc_html($tag->name); ?></h5>
                                <p class="card-text"><?php echo esc_html($tag->description); ?></p>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="btn btn-secondary">View Posts</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } else {
                echo '<p>No tags found.</p>';
            }
            ?>
        </div>
    </div>

  

<?php else : ?>
    <div class="container my-4">
        <h2 class="h4">No Results Found</h2>
        <p>Sorry, but nothing matched your search criteria. Please try again with different keywords.</p>
    </div>
<?php endif;

get_template_part('template-parts/footer'); ?>
