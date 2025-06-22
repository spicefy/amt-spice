<?php
// chat-support.php

$chat_title        = get_theme_mod('amt_chat_title', 'Our Impact');
$chat_text         = get_theme_mod('amt_chat_text', '15+ Million engagements per month across robust digital platforms.');
$chat_button_text  = get_theme_mod('amt_chat_button_text', 'View Statistics NOW');
$chat_button_link  = get_theme_mod('amt_chat_button_link', '#');
$chat_image        = get_theme_mod('amt_chat_image');
?>

<section style="background-color: var(--secondary-color);" class="text-center p-5 text-white ">
    <div class="container">
        <div class="row mb-4 justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                <h2 class="text-white"><?php echo esc_html($chat_title); ?></h2>
                <h4 class="text-white"><?php echo esc_html($chat_text); ?></h4>
            </div>
        </div>

        <!-- Social Media Reach Counter -->
        <div class="row mt-5">
            <?php
            $counters = array(
                array(
                    'icon'  => 'facebook',
                    'target'=> get_theme_mod('amt_counter_facebook', 15000),
                    'label' => get_theme_mod('amt_counter_facebook_label', 'Facebook Followers'),
                ),
                array(
                    'icon'  => 'instagram',
                    'target'=> get_theme_mod('amt_counter_instagram', 9500),
                    'label' => get_theme_mod('amt_counter_instagram_label', 'Instagram Followers'),
                ),
                array(
                    'icon'  => 'tiktok',
                    'target'=> get_theme_mod('amt_counter_tiktok', 12000),
                    'label' => get_theme_mod('amt_counter_tiktok_label', 'TikTok Followers'),
                ),
                array(
                    'icon'  => 'globe',
                    'target'=> get_theme_mod('amt_counter_website', 500000),
                    'label' => get_theme_mod('amt_counter_website_label', 'Monthly Website Visitors'),
                ),
            );

            foreach ($counters as $counter) :
                if ($counter['target']) :
                    ?>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="counter-item">
                            <?php
                            $icon_class = ($counter['icon'] === 'globe') ? 'fas fa-globe' : 'fab fa-' . esc_attr($counter['icon']);
                            ?>
                            <i class="<?php echo esc_attr($icon_class); ?> fa-2x mb-2"></i>
                            <div class="counter" data-target="<?php echo esc_attr($counter['target']); ?>">0</div>
                            <span><?php echo esc_html($counter['label']); ?></span>
                        </div>
                    </div>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
</section>

<style>
.text-white h2 {
    font-weight: 800;
    font-size: 2.8rem;
    color: #0e8e37;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
    text-align: center; /* Ensure text is centered */
}

.text-white h2::after {
    content: '';
    display: block;
    width: 80px;
    height: 5px;
    background:var(--primary-color);
    margin: 15px auto 0 auto; /* top margin, center horizontally */
}
</style>