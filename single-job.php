<?php
/**
 * Single Job Template
 * Theme: amt-spice
 */
get_template_part('template-parts/header');
?>
<?php custom_breadcrumbs(); 

if ( have_posts() ) : while ( have_posts() ) : the_post();
    $company = get_post_meta( get_the_ID(), '_job_company', true );
    $location = get_post_meta( get_the_ID(), '_job_location', true );
    $closing_date = get_post_meta( get_the_ID(), '_job_closing_date', true );
    $apply_url = get_post_meta( get_the_ID(), '_job_apply_url', true );
    $skills = get_post_meta( get_the_ID(), '_job_skills', true );
    $skills_arr = $skills ? array_map('trim', explode(',', $skills)) : array();
?>
<main class="job-single py-5 bg-light">
  <div class="container">
    <div class="card mb-4">
      <div class="card-body">
        <h1 class="h3"><?php the_title(); ?></h1>
        <div class="mb-2 text-muted">
          <i class="bi bi-building"></i> <?php echo esc_html($company); ?>
          <span class="mx-2">•</span>
          <i class="bi bi-geo-alt"></i> <?php echo esc_html($location); ?>
          <span class="mx-2">•</span>
          <i class="bi bi-clock"></i> <?php echo esc_html__('Closes:', 'amt-spice'); ?> <strong><?php echo $closing_date ? date_i18n( 'M j, Y', strtotime($closing_date) ) : '-'; ?></strong>
        </div>
        <?php if ($skills_arr): ?>
          <div class="mb-3">
            <?php foreach ($skills_arr as $skill): ?>
                <span class="badge bg-light text-dark me-1"><?php echo esc_html($skill); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <div class="mb-4"><?php the_content(); ?></div>
        <hr>
        <div class="mt-4">
          <h4><?php esc_html_e('How to Apply', 'amt-spice'); ?></h4>
          <?php if ($apply_url): ?>
            <a href="<?php echo esc_url($apply_url); ?>" class="btn btn-primary btn-lg" target="_blank"><?php esc_html_e('Apply via Application Form', 'amt-spice'); ?></a>
          <?php else: ?>
            <p>Send your CV and cover letter to <a href="mailto:jobs@example.com">jobs@example.com</a> with the subject "Application for [Job Title]".</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <a href="<?php echo esc_url( home_url('/job-vacancies/') ); ?>" class="btn btn-link"><i class="fa fa-arrow-left me-2" aria-hidden="true"></i> <?php esc_html_e('All Jobs', 'amt-spice'); ?></a>
  </div>
</main>
<?php endwhile; endif;
get_template_part('template-parts/footer'); ?>