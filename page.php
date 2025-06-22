<?php get_template_part('template-parts/header'); // Load custom headerget_header(); 

?>


<main id="content" role="main">
    <!-- Content -->
    <div class="container py-5">
        <!-- Card -->
        <div class="card shadow-lg border-0">
            <!-- Header -->
			
			<div class="card-header bg-primary  text-white w-100 px-4">
                <h1 class="card-title h2 text-white"><?php the_title(); ?></h1>
                <p class="card-text"><?php echo 'Last modified: ' . get_the_modified_date(); ?></p>

            </div>
			
            
            <!-- End Header -->

            <!-- Card Body -->
            <div class="card-body">
                <div class="mb-4">
                    <?php
                    // Display the page content
                    the_content();
                    ?>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Content -->
</main>

<?php get_template_part('template-parts/footer'); ?>