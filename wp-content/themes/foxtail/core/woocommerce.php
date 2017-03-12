<?php
/**
 * Created by PhpStorm.
 * User: nhansay
 * Date: 7/29/2016
 * Time: 3:38 PM
 */

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
    return $enqueue_styles;
}

add_action('wp_ajax_nopriv_foxtail_ajax-submit', 'foxtail_ajax_submit');
add_action('wp_ajax_foxtail_ajax-submit', 'foxtail_ajax_submit');
function foxtail_ajax_submit() {
    global $woocommerce;

    $nonce = $_POST['nonce'];
    if(!wp_verify_nonce($nonce, 'foxtail_product_nonce')) {
        wp_die('Busted!');
    }

    // Add product to cart... this works
    ob_flush();
    get_template_part( 'woocommerce/minicart-ajax' );
    $content = ob_get_clean();
    $data = array('content' => $content);
    $response = json_encode($data);
    header("Content-Type: application/json");
    echo $response;
    exit;
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_action('woocommerce_before_main_content', function() {
    if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<div id="breadcrumbs">','</div>');
});

//remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);

// single product pretty photo
add_action( 'wp_print_scripts', 'foxtail_deregister_prettyPhoto', 100 );
function foxtail_deregister_prettyPhoto() {
//    wp_deregister_script( 'prettyPhoto' );
    wp_deregister_script( 'prettyPhoto-init' );
//    wp_deregister_script( 'woocommerce_prettyPhoto_css' );
}

if ( class_exists( 'WooCommerce' ) ) {
    add_action('widgets_init', 'foxtail_woo_widgets_init');

    function foxtail_woo_widgets_init()
    {
        register_sidebar(array(
            'name' => __('Product Sidebar', 'foxtail'),
            'id' => 'sidebar-product',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<header class="widget-header"><h3 class="widget-title">',
            'after_title' => '</h3></header>',
            ));
    }
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter( 'woocommerce_product_tabs', 'foxtail_woocommerce_product_tabs' );
function foxtail_woocommerce_product_tabs( $tabs )
{
	$tabs['reviews']['title'] = __( 'Facebook Comment', 'foxtail' );
	return $tabs;
}

add_filter( 'woocommerce_get_price_html', 'foxtail_price_html', 100, 2 );
function foxtail_price_html( $price, $product ){
    if ( $product->regular_price == 0 )
        return '<span class="amount">Giá: Liên hệ</span>';
    else
        return $price;
}