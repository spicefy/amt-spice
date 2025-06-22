<?php
/**
 * Template part for displaying testimonials section.
 *
 * @package YourThemeName
 */

// Retrieve testimonials section settings from Customizer
// $testimonials_title = get_theme_mod('amt_testimonials_title', 'Testimonials');
// $testimonials_text = get_theme_mod('amt_testimonials_text', 'Visit our website lovemattersafrica.com today.');
// $testimonials_button_text = get_theme_mod('amt_testimonials_button_text', 'Learn More');
// $testimonials_button_link = get_theme_mod('amt_testimonials_button_link', '#');

// Retrieve testimonials from Customizer
// $testimonials_data = get_theme_mod('amt_testimonials_data', json_encode([]));
// $testimonials = json_decode($testimonials_data, true);



?>



<!-- Testimonials -->
<section class="bg-secondary py-2">
  <div class="container py-2 py-md-4 py-lg-5">
    
    <h2 class="h1 text-center pb-4 mb-1 mb-lg-3">
    <?php echo esc_html( get_theme_mod( 'gamba_testimonials_title', 'What Our Clients Say' ) ); ?>
    </h2>
    <div class="position-relative px-xl-5">

      

      <!-- Slider -->
      <div class="px-xl-2">
        <div class="swiper mx-n2" data-swiper-options='{
          "slidesPerView": 1,
          "loop": true,
          "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
          },
          "navigation": {
            "prevEl": "#prev-news",
            "nextEl": "#next-news"
          },
          "breakpoints": {
            "500": { "slidesPerView": 2 },
            "1000": { "slidesPerView": 3 }
          }
        }'>
        <div class="swiper-wrapper">

        <?php
$args = array(
    'post_type' => 'testimonial',
    'posts_per_page' => get_theme_mod( 'gamba_testimonials_count', 6 ) // Adjust as needed
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();

        $name = get_post_meta( get_the_ID(), '_testimonial_name', true );
        $designation = get_post_meta( get_the_ID(), '_testimonial_designation', true );
        $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); // fallback below

        if ( ! $thumbnail ) {
            $thumbnail = get_template_directory_uri() . '/assets/img/default-avatar.jpg'; // fallback image
        }
        ?>



              <!-- <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center ps-xl-5 ms-xxl-4">
                <div class="position-relative bg-dark rounded-circle flex-shrink-0 zindex-1 p-2 ms-4 ms-sm-0 mb-n5 mb-sm-0 me-sm-n5">
                  
                  <img src="<?php //echo esc_url( $thumbnail ); ?>" width="80" class="rounded-circle" alt="<?php //echo esc_attr( $name ); ?>">
                </div>
                <div class="card border-0 bg-secondary pt-5 pb-1 px-1 ps-sm-5 pe-sm-3 py-sm-3">
                  <div class="card-body">
                    
                    <p class="text-body fs-lg mb-3"><?php// echo esc_html( get_the_content() ); ?></p>
                    <h6 class="fs-sm fw-semibold mb-0"><?php //echo esc_html( $name ); ?></h6>
                    <span class="fs-xs text-muted"><?php //echo esc_html( $designation ); ?></span>
                  </div>
                </div>
              </div> -->

              <div class="swiper-slide h-auto pb-3">
        <figure class="d-flex flex-column h-100 px-2 px-sm-0 mb-0 mx-2">
            <div class="card h-100 position-relative border-0 shadow-sm pt-4">
                <blockquote class="card-body pb-3 mb-0">
                    <p class="mb-0"><?php echo esc_html( get_the_content() ); ?></p>
                </blockquote>
            </div>
            <figcaption class="d-flex align-items-center ps-4 pt-4">
                <img src="<?php echo esc_url( $thumbnail ); ?>" width="48" class="rounded-circle" alt="<?php echo esc_attr( $name ); ?>">
                <div class="ps-3">
                    <h6 class="fs-sm fw-semibold mb-0"><?php echo esc_html( $name ); ?></h6>
                    <span class="fs-xs text-muted"><?php echo esc_html( $designation ); ?></span>
                </div>
            </figcaption>
        </figure>
      </div>
        

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</div>
          <!-- Pagination (bullets) -->
          <div class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4"></div>

          

        </div>
      </div>

    </div> <!-- End position-relative -->
  </div> <!-- End container -->
</section>


        
        
   
<?php //endif; ?>
<!-- Testimonials Slideshow -->



