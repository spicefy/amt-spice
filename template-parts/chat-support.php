<?php
//chat-support.php
$chat_title = get_theme_mod('amt_chat_title', 'Our Impact');
$chat_text = get_theme_mod('amt_chat_text', 'Our trained health educators and chat bot are available in real time.');
$chat_button_text = get_theme_mod('amt_chat_button_text', 'View Statistics');
$chat_button_link = get_theme_mod('amt_chat_button_link', '#');
$chat_image = get_theme_mod('amt_chat_image');
?>

<section style="background-color: var(--secondary-color);" class="text-center p-5 text-white d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row mb-4 justify-content-center">
            <div class="col-md-8 col-lg-6 text-center"> <!-- Adjusted column width and added text-center -->
                <h2><?php echo esc_html($chat_title); ?></h2>
                <p class="lead"><?php echo esc_html($chat_text); ?></p>
                <a href="<?php echo esc_url($chat_button_link); ?>" class="btn btn-light btn-lg btn-wide mt-3"><?php echo esc_html($chat_button_text); ?></a>
            </div>
        </div>

        <!-- Social Media Reach Counter -->
        <div class="row mt-5">
            <?php
            $counters = array(
                array(
                    'icon' => 'facebook',
                    'target' => get_theme_mod('amt_counter_facebook', 15000),
                    'label' => get_theme_mod('amt_counter_facebook_label', 'Facebook Followers')
                ),
                array(
                    'icon' => 'instagram',
                    'target' => get_theme_mod('amt_counter_instagram', 9500),
                    'label' => get_theme_mod('amt_counter_instagram_label', 'Instagram Followers')
                ),
                array(
                    'icon' => 'tiktok',
                    'target' => get_theme_mod('amt_counter_tiktok', 12000),
                    'label' => get_theme_mod('amt_counter_tiktok_label', 'TikTok Followers')
                ),
                array(
                    'icon' => 'globe',
                    'target' => get_theme_mod('amt_counter_website', 500000),
                    'label' => get_theme_mod('amt_counter_website_label', 'Monthly Website Visitors')
                )
            );
            
            foreach ($counters as $counter) {
                if ($counter['target']) {
                    echo '<div class="col-md-3 col-6 mb-4">';
                    echo '<div class="counter-item">';
                    $icon_class = ($counter['icon'] === 'globe') ? 'fas fa-globe' : 'fab fa-' . esc_attr($counter['icon']);
echo '<i class="' . esc_attr($icon_class) . ' fa-2x mb-2"></i>';

                    echo '<div class="counter" data-target="' . esc_attr($counter['target']) . '">0</div>';
                    echo '<span>' . esc_html($counter['label']) . '</span>';
                    echo '</div></div>';
                }
            }
            ?>
        </div>
    </div>
</section>