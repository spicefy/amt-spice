<div class="container">
    <div class="row">

<!-- Main Content Section added text-start -->
    <div class="col-xl-12 mb-5">
            <?php
            while (have_posts()) : the_post();
                the_title('<h1 class="display-4 mb-4">', '</h1>');
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</div>