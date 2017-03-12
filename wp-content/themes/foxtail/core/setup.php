<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}

/**
 * Assign the Foxtail version to a var
 */
$theme = wp_get_theme('foxtail');
$foxtail_version = $theme['Version'];

add_action( 'after_setup_theme', 'foxtail_setup' );

if (!function_exists('foxtail_setup'))
{
    function foxtail_setup()
    {
        // wp-content/languages/themes/foxtail-it_IT.mo
        load_theme_textdomain('foxtail', trailingslashit(WP_LANG_DIR) . 'themes/');

        // wp-content/themes/child-theme-name/languages/it_IT.mo
        load_theme_textdomain('foxtail', get_stylesheet_directory() . '/languages');

        // wp-content/themes/foxtail/languages/it_IT.mo
        load_theme_textdomain('foxtail', get_template_directory() . '/languages');

        /**
         * Add default posts and comments RSS feed links to head.
         */
        add_theme_support('automatic-feed-links');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'main-nav' => __('Main Nav', 'foxtail')
        ));

        /*
         * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'widgets',
        ));

        // Declare WooCommerce support
        add_theme_support('woocommerce');

        // Declare support for title theme feature
        add_theme_support('title-tag');

        // add image size
        set_post_thumbnail_size( 220, 180, true );
//        add_image_size( 'slider', 848, 350, true );
        add_image_size( 'small-thumb', 55, 55, true );
    }
}
// end function foxtail_setup


/**
 * ==========> Create custom taxonomy and custom post type
 */
//add_action('init', 'foxtail_create_custom_taxonomies');
//add_action('init', 'foxtail_create_custom_post_types');

function foxtail_create_custom_taxonomies()
{
//    register_taxonomy('album-category', 'album', array(
//        'labels' => array(
//            'name' => 'Album Categories',
//            'singular' => 'Album Category',
//            'menu_name' => 'Album Categories'
//        ),
//        'hierarchical' => true,
//        'public' => true,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'show_in_nav_menus' => true,
//        'show_tagcloud' => true,
////        'rewrite' => array(
////            'slug' => ''
////        )
//    ));


}

function foxtail_create_custom_post_types()
{
    register_post_type('slider', array(
        'labels' => array(
            'name' => 'Sliders', // Tên post type dạng số nhiều
            'singular_name' => 'Slider' // Tên post type dạng số ít
        ),
        'description' => 'Sliders', // Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail'
        ), // Các tính năng được hỗ trợ trong post type

        'public' => true, // Kích hoạt post type
        'show_ui' => true, // Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, // Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, // Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, // Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 7, // Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-images-alt2', // Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, // Có thể export nội dung bằng Tools -> Export
        'has_archive' => false, // Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => true, // Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, // Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    ));

//    register_post_type('video', array(
//        'labels' => array(
//            'name' => 'Videos', // Tên post type dạng số nhiều
//            'singular_name' => 'Videos' // Tên post type dạng số ít
//        ),
//        'description' => 'Videos', // Mô tả của post type
//        'supports' => array(
//            'title',
//            'thumbnail',
//            'editor'
//        ), // Các tính năng được hỗ trợ trong post type
//
//        'public' => true, // Kích hoạt post type
//        'show_ui' => true, // Hiển thị khung quản trị như Post/Page
//        'show_in_menu' => true, // Hiển thị trên Admin Menu (tay trái)
//        'show_in_nav_menus' => true, // Hiển thị trong Appearance -> Menus
//        'show_in_admin_bar' => true, // Hiển thị trên thanh Admin bar màu đen.
//        'menu_position' => 7, // Thứ tự vị trí hiển thị trong menu (tay trái)
//        'menu_icon' => 'dashicons-admin-collapse', // Đường dẫn tới icon sẽ hiển thị
//        'can_export' => true, // Có thể export nội dung bằng Tools -> Export
//        'has_archive' => true, // Cho phép lưu trữ (month, date, year)
//        'exclude_from_search' => false, // Loại bỏ khỏi kết quả tìm kiếm
//        'publicly_queryable' => true, // Hiển thị các tham số trong query, phải đặt true
//        'capability_type' => 'post',
//        'taxonomies' => array('post_tag')
//    ));

    register_post_type('customer', array(
        'labels' => array(
            'name' => 'Customers', // Tên post type dạng số nhiều
            'singular_name' => 'Customer' // Tên post type dạng số ít
        ),
        'description' => 'Customer Comments', // Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail',
            'editor'
        ), // Các tính năng được hỗ trợ trong post type

        'public' => true, // Kích hoạt post type
        'show_ui' => true, // Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, // Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, // Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, // Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 7, // Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-smiley', // Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, // Có thể export nội dung bằng Tools -> Export
        'has_archive' => false, // Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => true, // Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, // Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post'
    ));
}

/**
 * Register widget area.
 */
add_action('widgets_init', 'foxtail_widgets_init');

function foxtail_widgets_init()
{
    register_sidebar(array(
        'name' => __('Left Sidebar', 'foxtail'),
        'id' => 'sidebar-left',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<header class="widget-header"><h3 class="widget-title">',
        'after_title' => '</h3></header>',
    ));

    register_sidebar(array(
        'name' => __('Right Sidebar', 'foxtail'),
        'id' => 'sidebar-right',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<header class="widget-header"><h3 class="widget-title">',
        'after_title' => '</h3></header>',
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar', 'foxtail'),
        'id' => 'sidebar-footer',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar 1', 'foxtail'),
        'id' => 'sidebar-footer-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar 2', 'foxtail'),
        'id' => 'sidebar-footer-2',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar 3', 'foxtail'),
        'id' => 'sidebar-footer-3',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

   register_sidebar(array(
       'name' => __('Footer Sidebar 4', 'foxtail'),
       'id' => 'sidebar-footer-4',
       'description' => '',
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ));
}

/**
 * Enqueue scripts
 */
add_action( 'wp_enqueue_scripts', 'foxtail_styles', 10 );

function foxtail_styles()
{
    global $foxtail_version;

    wp_enqueue_style('foxtail-style', get_stylesheet_uri(), array());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom.css', array());
    wp_enqueue_style('font-awesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array());
}

add_action( 'wp_enqueue_scripts', 'foxtail_scripts', 10 );

function foxtail_scripts()
{
    global $foxtail_version;

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), $foxtail_version, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), $foxtail_version, true);
//    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), $foxtail_version, true);

    wp_enqueue_script('woo-ajax-cart-js', get_template_directory_uri().'/js/woo-ajax-cart.js');
    wp_localize_script(
        'woo-ajax-cart-js',
        'foxtail_ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'foxtail_product_nonce' => wp_create_nonce('foxtail_product_nonce'),
            'loader_img_src' => get_template_directory_uri().'/img/loader.gif'
        )
    );
    if ( class_exists( 'WooCommerce' ) ) {
        if (is_product()) {
            wp_enqueue_script('woo-single-product', get_template_directory_uri().'/js/woo-single-product.js', array('jquery'), $foxtail_version);
        }
    }

}

/*
 * Change archive title
 */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '', false );

    } elseif ( is_author() ) {

        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    }

    return $title;

});

/*
 * get post view
 */
function foxtail_set_post_views($postID) {
    $count_key = 'foxtail_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function foxtail_get_post_views($postID){
    $count_key = 'foxtail_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

//remove_filter ('the_content',  'wpautop');
//remove_filter ('the_excerpt',  'wpautop');

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
    return ' ...';
}