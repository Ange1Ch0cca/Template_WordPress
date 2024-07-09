<?php
function blog_personalisimo_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'blog-personalisimo'),
    ));
}
add_action('after_setup_theme', 'blog_personalisimo_setup');

function blog_personalisimo_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css');
    wp_enqueue_style('boxicons', get_template_directory_uri() . '/assets/vendor/boxicons/css/boxicons.min.css');
    wp_enqueue_style('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css');
    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', array('jquery'), null, true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'blog_personalisimo_scripts');

function custom_theme_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('glightbox-css', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css');
    wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('glightbox-js', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', array(), false, true);
    wp_enqueue_script('isotope-js', get_template_directory_uri() . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', array(), false, true);
    wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), false, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');

require_once get_template_directory() . '/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

// Register Custom Post Type: Portfolio
function custom_post_type_portfolio() {
    $labels = array(
        'name' => _x('Portfolios', 'Post Type General Name', 'your-text-domain'),
        'singular_name' => _x('Portfolio', 'Post Type Singular Name', 'your-text-domain'),
        'menu_name' => __('Portfolios', 'your-text-domain'),
        'all_items' => __('All Portfolios', 'your-text-domain'),
        'add_new_item' => __('Add New Portfolio', 'your-text-domain'),
        'add_new' => __('Add New', 'your-text-domain'),
        'new_item' => __('New Portfolio', 'your-text-domain'),
        'edit_item' => __('Edit Portfolio', 'your-text-domain'),
        'update_item' => __('Update Portfolio', 'your-text-domain'),
        'view_item' => __('View Portfolio', 'your-text-domain'),
        'search_items' => __('Search Portfolio', 'your-text-domain'),
    );

    $args = array(
        'label' => __('Portfolio', 'your-text-domain'),
        'description' => __('Portfolio Description', 'your-text-domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('portfolio_category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'custom_post_type_portfolio', 0);

// Register Custom Taxonomy: Portfolio Category
function custom_taxonomy_portfolio_category() {
    $labels = array(
        'name' => _x('Portfolio Categories', 'Taxonomy General Name', 'your-text-domain'),
        'singular_name' => _x('Portfolio Category', 'Taxonomy Singular Name', 'your-text-domain'),
        'menu_name' => __('Portfolio Categories', 'your-text-domain'),
        'all_items' => __('All Categories', 'your-text-domain'),
        'parent_item' => __('Parent Category', 'your-text-domain'),
        'parent_item_colon' => __('Parent Category:', 'your-text-domain'),
        'new_item_name' => __('New Category Name', 'your-text-domain'),
        'add_new_item' => __('Add New Category', 'your-text-domain'),
        'edit_item' => __('Edit Category', 'your-text-domain'),
        'update_item' => __('Update Category', 'your-text-domain'),
        'view_item' => __('View Category', 'your-text-domain'),
        'search_items' => __('Search Categories', 'your-text-domain'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );

    register_taxonomy('portfolio_category', array('portfolio'), $args);
}
add_action('init', 'custom_taxonomy_portfolio_category', 0);

function theme_prefix_setup() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_prefix_setup');







?>
