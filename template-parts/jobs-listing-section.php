<?php
/**
 * Job Listings Section Template
 * Usage: get_template_part('template-parts/jobs-listing-section');
 * Theme: amt-spice
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// Fetch jobs from DB
$args = array(
    'post_type'      => 'job',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_job_closing_date',
    'order'          => 'ASC'
);
$jobs_query = new WP_Query($args);

function amt_spice_get_status_label($status) {
    switch ($status) {
        case 'active':
            return array('Active', 'success');
        case 'closing_soon':
            return array('Closing Soon', 'warning text-dark');
        case 'expired':
            return array('Expired', 'secondary');
        default:
            return array('Unknown', 'secondary');
    }
}

function amt_spice_job_status($closing_date) {
    $now = current_time('Y-m-d');
    if (!$closing_date) return 'active';
    $date_now = new DateTime($now);
    $date_close = new DateTime($closing_date);
    $interval = $date_now->diff($date_close);
    $days = (int)$interval->format('%r%a');
    if ($days < 0) {
        return 'expired';
    } elseif ($days <= 2) {
        return 'closing_soon';
    } else {
        return 'active';
    }
}

function amt_spice_job_days_remaining($closing_date) {
    if (!$closing_date) return '';
    $now = current_time('Y-m-d');
    $date_now = new DateTime($now);
    $date_close = new DateTime($closing_date);
    $interval = $date_now->diff($date_close);
    $days = (int)$interval->format('%r%a');
    if ($days > 1) return $days . ' days remaining';
    if ($days === 1) return '1 day remaining';
    if ($days === 0) return 'Closes today';
    if ($days < 0) return 'Deadline passed';
    return '';
}
?>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12">
        <h2 class="mb-3"><?php esc_html_e('Current Job Openings', 'amt-spice'); ?></h2>
        
        <!-- Search and Filter (static UI, JS/AJAX can be added later) -->
        <div class="filter-section bg-white p-4 rounded shadow-sm mb-4">
          <div class="row g-3 align-items-end">
            <div class="col-md-5">
              <label class="form-label"><?php esc_html_e('Search', 'amt-spice'); ?></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="<?php esc_attr_e('Job title, keywords...', 'amt-spice'); ?>">
              </div>
            </div>
            <div class="col-md-3">
              <label class="form-label"><?php esc_html_e('Location', 'amt-spice'); ?></label>
              <select class="form-select">
                <option selected><?php esc_html_e('All Locations', 'amt-spice'); ?></option>
                <option>Remote</option>
                <option>On-site</option>
                <option>Hybrid</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label"><?php esc_html_e('Status', 'amt-spice'); ?></label>
              <select class="form-select">
                <option selected><?php esc_html_e('All Statuses', 'amt-spice'); ?></option>
                <option value="active"><?php esc_html_e('Active', 'amt-spice'); ?></option>
                <option value="expired"><?php esc_html_e('Expired', 'amt-spice'); ?></option>
                <option value="closing_soon"><?php esc_html_e('Closing Soon', 'amt-spice'); ?></option>
              </select>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary w-100"><?php esc_html_e('Filter', 'amt-spice'); ?></button>
            </div>
          </div>
        </div>
        
        <!-- Job Listings -->
        <div class="row">
          <div class="col-12">
            <?php if ( $jobs_query->have_posts() ) : ?>
                <?php
                // Counters for legend
                $count_active = $count_closing = $count_expired = 0;
                ?>
                <?php while ( $jobs_query->have_posts() ) : $jobs_query->the_post();
                    $company = get_post_meta( get_the_ID(), '_job_company', true );
                    $location = get_post_meta( get_the_ID(), '_job_location', true );
                    $closing_date = get_post_meta( get_the_ID(), '_job_closing_date', true );
                    $apply_url = get_post_meta( get_the_ID(), '_job_apply_url', true );
                    $skills = get_post_meta( get_the_ID(), '_job_skills', true );
                    $skills_arr = $skills ? array_map('trim', explode(',', $skills)) : array();

                    // Status auto-calculated
                    $status = amt_spice_job_status($closing_date);
                    $status_label = amt_spice_get_status_label($status);

                    // Count for legend
                    if ($status === 'active') $count_active++;
                    if ($status === 'closing_soon') $count_closing++;
                    if ($status === 'expired') $count_expired++;

                    // Border class
                    $border_class = 'border-' . explode(' ', $status_label[1])[0];
                    ?>
                    <div class="card job-card mb-3 border-start <?php echo esc_attr($border_class); ?> border-4">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-md-2 text-center mb-3 mb-md-0">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php echo esc_attr($company); ?>" class="company-logo img-fluid">
                            <?php else : ?>
                                <img src="https://via.placeholder.com/80" alt="<?php echo esc_attr($company); ?>" class="company-logo img-fluid">
                            <?php endif; ?>
                          </div>
                          <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-start">
                              <h4 class="h5 mb-1"><?php the_title(); ?></h4>
                              <span class="badge bg-<?php echo esc_attr($status_label[1]); ?>"><?php echo esc_html($status_label[0]); ?></span>
                            </div>
                            <p class="mb-2 text-muted">
                              <i class="bi bi-building"></i> <?php echo esc_html($company); ?>
                              <span class="mx-2">•</span>
                              <i class="bi bi-geo-alt"></i> <?php echo esc_html($location); ?>
                              <span class="mx-2">•</span>
                              <i class="bi bi-clock"></i>
                              <?php
                                if ($status === 'expired') {
                                    echo esc_html__('Closed:', 'amt-spice') . ' <strong>' . ( $closing_date ? date_i18n( 'M j, Y', strtotime($closing_date) ) : '-' ) . '</strong>';
                                } else {
                                    echo esc_html__('Closes:', 'amt-spice') . ' <strong>' . ( $closing_date ? date_i18n( 'M j, Y', strtotime($closing_date) ) : '-' ) . '</strong>';
                                }
                              ?>
                            </p>
                            <p class="mb-2"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <div>
                              <?php foreach ($skills_arr as $skill) :
                                  if ($skill) : ?>
                                    <span class="badge bg-light text-dark me-1"><?php echo esc_html($skill); ?></span>
                                  <?php endif;
                              endforeach; ?>
                            </div>
                          </div>
                          <div class="col-md-3 text-md-end">
                            <?php if ($status === 'expired'): ?>
                                <button class="btn btn-outline-secondary mb-2" disabled><?php esc_html_e('Application Closed', 'amt-spice'); ?></button>
                                <div class="text-muted small"><?php echo amt_spice_job_days_remaining($closing_date); ?></div>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary mb-2"><?php esc_html_e('Apply Now', 'amt-spice'); ?></a>
                                <div class="<?php echo ($status === 'closing_soon') ? 'text-warning' : 'text-muted'; ?> small">
                                  <?php
                                    if ($status === 'closing_soon') echo '<i class="bi bi-exclamation-triangle"></i> ';
                                    echo amt_spice_job_days_remaining($closing_date);
                                  ?>
                                </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- Status Legend -->
                <div class="d-flex justify-content-end mt-3 mb-4">
                  <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-success"><?php printf(esc_html__('Active (%d)', 'amt-spice'), $count_active); ?></button>
                    <button type="button" class="btn btn-warning text-dark"><?php printf(esc_html__('Closing Soon (%d)', 'amt-spice'), $count_closing); ?></button>
                    <button type="button" class="btn btn-secondary"><?php printf(esc_html__('Expired (%d)', 'amt-spice'), $count_expired); ?></button>
                  </div>
                </div>
                <!-- Pagination placeholder (static, for demo) -->
                <nav class="mt-4">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1"><?php esc_html_e('Previous', 'amt-spice'); ?></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#"><?php esc_html_e('Next', 'amt-spice'); ?></a>
                    </li>
                  </ul>
                </nav>
            <?php else: ?>
                <div class="alert alert-info"><?php esc_html_e('No job vacancies found.', 'amt-spice'); ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>