<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <?php
        // Get the logo from theme mods
        $logo = get_theme_mod('amt_logo');
        if ($logo) {
            echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">
                    <img src="' . esc_url($logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '">
                  </a>';
        } else {
            echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>';
        }
        ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            // Display WordPress menu
            wp_nav_menu([
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_class'      => 'navbar-nav ms-auto',
                'fallback_cb'     => '__return_false',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 2,
                //'walker'         => new Bootstrap_NavWalker() changed to:
                'walker' => new WP_Bootstrap_Navwalker()
            ]);
            ?>

            <!-- Donate Button (Visible in both mobile and desktop menus) -->
            <?php
            $donate_link = get_theme_mod('amt_donate_link', '#');
            $donate_text = get_theme_mod('amt_donate_text', 'Donate');
            ?>
            <div class="d-lg-block mt-3 mt-lg-0">
                <a href="<?php echo esc_url($donate_link); ?>" class="btn btn-outline-secondary w-100 w-lg-auto">
                    <?php echo esc_html($donate_text); ?>
                </a>
            </div>
        </div>
    </div>
</nav>
