<?php

function kru_setup() {
  load_theme_textdomain('kru');

  add_theme_support('automatic-feed-links');

  add_theme_support('title-tag');

  add_theme_support('custom-logo', array(
    'height' => 150,
    'width' => 300,
    'flex-height' => true
  ));

  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 300, 300 );

  // Menus
  register_nav_menus(array(
    'header-nav' => __('Header Nav', 'kru'),
    'social-nav'  => __('Social Nav', 'kru'),
  ));

    /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption'
  ));

  add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'status',
    'audio',
    'chat'
  ));
}
add_action( 'after_setup_theme', 'kru_setup' );

function kru_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'kru' ),
    'id'            => 'sidebar',
    'description'   => __( 'Add widgets here to appear in your sidebar.', 'kru' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer', 'kru' ),
    'id'            => 'footer',
    'description'   => __( 'Appears at the bottom of the page.', 'kru' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'kru_widgets_init' );

// TinyMCE stuff

// Callback function to insert 'styleselect' into the $buttons array
function kru_tinymce_buttons( $buttons ) {
    // Just remove the format select.
    // $buttons = array_diff($buttons, array('formatselect'));

    // Remove all of the default buttons here, they're not useful.
    // $buttons = array();

    // Push the Style Select onto the buttons.
    array_unshift( $buttons, 'styleselect' );

    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons', 'kru_tinymce_buttons');

// Get our custom editor styles.
function kru_add_editor_styles() {
  add_editor_style(get_template_directory_uri() . '/css/tinymce.css');
}
add_action('admin_init', 'kru_add_editor_styles');

// Load our scripts & styles.
function kru_scripts() {
  wp_register_style('kru-style', get_template_directory_uri() . '/static/css/style.css', array(), '1.0.1', 'all');
  wp_enqueue_style('kru-style');

  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/static/js/bootstrap.min.js', array( ), '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'kru_scripts' );

// Add page slug to body class.
// Based on https://github.com/nathanstaines/starkers-html5 (GPL 2)
function kru_add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  if($post && $post->post_parent) {
    // Get the parent
    $parent = get_post($post->post_parent);
    $classes[] = 'parent-'.$parent->post_name;

    // Get the grandparent, but no further.
    if($parent->post_parent) {
      $grandparent = get_post($parent->post_parent);
      $classes[] = 'grandparent-'.$grandparent->post_name;
    }
  }

  return $classes;
}
add_filter( 'body_class', 'kru_add_slug_to_body_class' );

