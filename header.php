<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header id="masthead" class="site-header" role="banner">
    <nav class="navigation">
      <div class="navbar-header">
        <div class="site-branding">
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        </div><!-- .site-branding -->

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <nav class="navbar-collapse collapse" id="navbar">
        <?php
          wp_nav_menu(array(
            'theme_location' => 'header-nav',
            'menu_class' => 'main-navigation nav navbar-nav',
            'container' => false
           ));
        ?>
        <?php
          wp_nav_menu(array(
            'theme_location' => 'social-nav',
            'menu_class' => 'social-navigation nav navbar-nav',
            'link_before' => '<span class="screen-reader-text">',
            'link_after' => '</span>',
            'container' => false
          ));
        ?>
      </nav><!-- .social-navigation -->

    </div><!-- .site-header-main -->

  </header><!-- .site-header -->