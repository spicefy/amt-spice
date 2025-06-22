<?php
/**
 * Template Name: Company Timeline
 */
get_template_part('template-parts/header');
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1><?php echo get_theme_mod('timeline_title', 'Company History Timeline with Milestones Achieved'); ?></h1>
            <p class="lead"><?php echo get_theme_mod('timeline_description', 'This section covers details regarding firm history in terms of milestones achieved presented in timeline format.'); ?></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="timeline">
                <?php
                $timeline_items = json_decode(get_theme_mod('timeline_items', '[]'), true);
                if (!empty($timeline_items)) {
                    foreach ($timeline_items as $index => $item) {
                        $alignment = ($index % 2 == 0) ? 'left' : 'right';
                        ?>
                        <div class="timeline-item timeline-item-<?php echo $alignment; ?>">
                            <div class="timeline-content">
                                <div class="timeline-date">
                                    <span class="timeline-month"><?php echo esc_html($item['month']); ?></span>
                                    <span class="timeline-year"><?php echo esc_html($item['year']); ?></span>
                                </div>
                                <div class="timeline-event">
                                    <?php echo esc_html($item['event']); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Default timeline items if none are set
                    $default_items = array(
                        array('year' => '2003', 'month' => 'JUNE', 'event' => 'Firm Established as Entity'),
                        array('year' => '2010', 'month' => 'AUGUST', 'event' => 'Extraction initiated of precious metals'),
                        array('year' => '2012', 'month' => 'OCTOBER', 'event' => 'Licensed and certification from government'),
                        array('year' => '2014', 'month' => 'JANUARY', 'event' => 'Developed sustainable measures while mining & extraction'),
                        array('year' => '2018', 'month' => 'DECEMBER', 'event' => '5000+ square kilometer contact area'),
                        array('year' => '2019', 'month' => 'MARCH', 'event' => 'Produced first gold'),
                    );
                    
                    foreach ($default_items as $index => $item) {
                        $alignment = ($index % 2 == 0) ? 'left' : 'right';
                        ?>
                        <div class="timeline-item timeline-item-<?php echo $alignment; ?>">
                            <div class="timeline-content">
                                <div class="timeline-date">
                                    <span class="timeline-month"><?php echo esc_html($item['month']); ?></span>
                                    <span class="timeline-year"><?php echo esc_html($item['year']); ?></span>
                                </div>
                                <div class="timeline-event">
                                    <?php echo esc_html($item['event']); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/footer'); ?>