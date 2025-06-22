<!DOCTYPE html>
<html <?php language_attributes(); ?>  data-bs-theme="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); 
	
$navbar_position = get_theme_mod('navbar_position', 'normal');
	?>
<main class="page-wrapper">



<header class="header navbar navbar-expand-lg  <?php echo esc_attr($navbar_position === 'fixed-top' ? 'fixed-top' : ($navbar_position === 'sticky-top' ? 'sticky-top' : '')); ?>">
  <div class="container px-3">

    <?php
    // Get the logo from theme mods
    $logo = get_theme_mod('amt_logo');
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand pe-3">
      <?php if ($logo): ?>
        <img src="<?php echo esc_url($logo); ?>" width="47" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
      <?php endif; ?>
      <?php echo esc_html(get_bloginfo('name')); ?>
    </a>

    <div id="navbarNav" class="offcanvas offcanvas-end">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body ms-lg-auto">
        <?php
        wp_nav_menu([
          'theme_location'  => 'primary',
          'container'       => false,
          'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
          'fallback_cb'     => '__return_false',
          'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth'           => 2,
          'walker'          => new WP_Bootstrap_Navwalker()
        ]);
        ?>
      </div>
      <div class="offcanvas-header border-top">
        <?php
        $donate_link = get_theme_mod('amt_donate_link', '#');
        $donate_text = get_theme_mod('amt_donate_text', 'Donate');
        ?>
        <a href="<?php echo esc_url($donate_link); ?>" class="btn btn-outline-secondary btn-lg btn-wide text-decoration-none rounded-pill  w-100 w-lg-auto">
          <i class="bx bx-heart fs-4 lh-1 me-1"></i>
          &nbsp;<?php echo esc_html($donate_text); ?>
        </a>
      </div>
    </div>

    

    <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a href="<?php echo esc_url($donate_link); ?>" class="btn btn-outline-secondary btn-lg btn-wide text-decoration-none rounded-pill  w-100 w-lg-auto d-none d-lg-inline-flex" target="_blank" rel="noopener">
      <i class="bx bx-heart fs-5 lh-1 me-1"></i>
      &nbsp;<?php echo esc_html($donate_text); ?>
    </a>
    
  </div>
</header>

