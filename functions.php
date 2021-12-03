<?php
// require NavWalker class for bootstrap navigation menu
// require_once "mega-navwalker.php";
require_once "wp-bootstrap-navwalker.php";

// add css files
function gora_add_styles()
{
  wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/all.min.css');
  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
  wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
}

// add js files
function gora_add_scripts()
{
  wp_deregister_script( 'jquery' );
  wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), false, true); // register jquery in footer
  wp_enqueue_script('jquery'); // enqueue jquery
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
  wp_enqueue_script('gora-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
}

add_action( 'wp_enqueue_scripts', 'gora_add_styles'); // runs gora_add_styles function when hook wp_enqueue_scripts called.
add_action( 'wp_enqueue_scripts', 'gora_add_scripts');

// add our custom menus
function gora_register_custom_menus() 
{
  register_nav_menus(array(
    'nav-menu' => 'Navigation Bar',
    'footer-menu' => 'Footer Menu'
  ));
}

function gora_nav_menu() 
{
  wp_nav_menu(array(
    'theme_location'  => 'nav-menu',
    'container'       => false,
    'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
    // 'walker'          => new WalkerNav(),
    'walker'          => new WP_Bootstrap_Navwalker()
  ));
}

add_action('init', 'gora_register_custom_menus'); // runs gora_register_custom_menus function when hook init called.

add_theme_support( 'post-thumbnails' ); // add featured image support to our theme.

function gora_extend_excerpt_length($length) 
{
  if (is_author()) {
    return 30;
  } else if (is_category('programming')) {
    return 40;
  } else if (is_category()) {
    return 50;
  } 
  return 60;
}

add_filter('excerpt_length', 'gora_extend_excerpt_length');

function gora_excerpt_change_dots($more)
{
  return ' ...';
}

add_filter('excerpt_more', 'gora_excerpt_change_dots');

function gora_numbering_pagination()
{
  global $wp_query; // wp_query is an instance of WP_Query class
  $all_pages = $wp_query->max_num_pages; // get the total number of pages
  $current_page = max(1, get_query_var('paged')); // get the current page number
  if ($all_pages > 1) {
    return paginate_links(array(
      'base'    => get_pagenum_link() . '%_%',
      'format'  => 'page/%#%',
      'current' => $current_page,
      'prev_text' => '«',
      'next_text' => '»'
    ));
  }
}

function gora_main_sidebar()
{
  // register main sidebar
  register_sidebar(array(
    'name'          => 'Main Sidebar',
    'id'            => 'main-sidebar',
    'description'   => 'The theme main sidebar that appear in every page',
    'class'         => 'main-sidebar',
    'before_widget' => '<div class="widget-content">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'  => '</h3>'
  ));
}

add_action('widgets_init', 'gora_main_sidebar');