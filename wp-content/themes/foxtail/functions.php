<?php

/**
 * Setup:
 * Load theme text domain
 * Register nav, widget
 * Register custom post type
 * Enqueue styles, etc.
 */

require get_template_directory() . '/core/setup.php';

/**
 * Structure
 */
require get_template_directory() . '/core/structure.php';

/**
 * Wiget
 */
require get_template_directory() . '/core/widgets.php';

/**
 * Theme options by Redux framework
 */
require get_template_directory() . '/core/options.php';

/**
 * WooCommerce
 */
require get_template_directory() . '/core/woocommerce.php';

/**
 * Visual Composer
 */
require get_template_directory() . '/core/visual-composer.php';

/**
 * Custom WP Admin
 */
require get_template_directory() . '/core/custom-wp-admin.php';

// =======================================================================
/**
 * Load custom post type archive on home page
 *
 * Reference: http://www.wpaustralia.org/wordpress-forums/topic/pre_get_posts-and-is_front_page/
 * Reference: http://wordpress.stackexchange.com/questions/30851/how-to-use-a-custom-post-type-archive-as-front-page
 */
function prefix_simso_front_page( $query ) {

    // Only filter the main query on the front-end
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    global $wp;
    $front = false;

    // If the latest posts are showing on the home page
    if ( ( is_home() && empty( $wp->query_string ) ) ) {
        $front = true;
    }

    // If a static page is set as the home page
    if ( ( $query->get( 'page_id' ) == get_option( 'page_on_front' ) && get_option( 'page_on_front' ) ) || empty( $wp->query_string ) ) {
        $front = true;
    }

    if ( $front ) :
    $query->set( 'post_type', 'simso' );
    $query->set( 'page_id', '' );

    if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
    elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
    else { $paged = 1; }
    $query->set( 'paged', $paged );

        // Set properties to match an archive
    $query->is_page = 0;
    $query->is_singular = 0;
    $query->is_post_type_archive = 1;
    $query->is_archive = 1;
    // $query->is_tax = 1;

    endif;

}
// add_action( 'pre_get_posts', 'prefix_simso_front_page' );

//Custom query trước khi lấy danh sách Sim
add_action('pre_get_posts', 'vifonic_custom_query_loai_sim' );

function vifonic_custom_query_loai_sim( $wp_query ) {
    // Figure out if we need to exclude glossary - exclude from
    // archives (except category archives), feeds, and home page
    // Only filter the main query on the front-end
    if ( ! $wp_query->is_main_query() ) {
        return;
    }
    if( ( is_search() || is_archive() ) && isset($_GET['filter'])) {
        $filter_query = array();

        $sim_do_dai = isset($_GET['sim_do_dai']) ? $_GET['sim_do_dai'] : 'all';
        $sim_muc_gia = isset($_GET['sim_muc_gia']) ? $_GET['sim_muc_gia'] : 'all';
        $sim_mang_di_dong = isset($_GET['sim_mang_di_dong']) ? $_GET['sim_mang_di_dong'] : 'all';
        $sim_sap_xep = isset($_GET['sim_sap_xep']) ? $_GET['sim_sap_xep'] : '0';

        $filter_query['relation'] = 'AND';
        //ĐỘ DÀI
        if ($sim_do_dai == '10') {
            $filter_query['relation'] = 'AND';
            array_push($filter_query, array(
                'key' => 'sim_so',
                'value' => '999999999',
                'compare' => '<=',
                'type' => 'NUMERIC'
                )
            );
            array_push($filter_query, array(
                'key' => 'sim_so',
                'value' => '900000000',
                'compare' => '>=',
                'type' => 'NUMERIC'
                )
            );
        } elseif ($sim_do_dai == '11') {
            $filter_query['relation'] = 'AND';
            array_push($filter_query, array(
                'key' => 'sim_so',
                'value' => '1000000000',
                'compare' => '>=',
                'type' => 'NUMERIC'
                )
            );
            array_push($filter_query, array(
                'key' => 'sim_so',
                'value' => '1699999999',
                'compare' => '<=',
                'type' => 'NUMERIC'
                )
            );
        }

        //MỨC GIÁ
        if ($sim_muc_gia == 'all') {
            array_push($filter_query, array(
                'key' => 'gia_ban',
                'value' => '0',
                'compare' => '>=',
                'type' => 'NUMERIC'
                )
            );
        } elseif ($sim_muc_gia == '1') {
            array_push($filter_query, array(
                'key' => 'gia_ban',
                'value' => '1000000',
                'compare' => '<',
                'type' => 'NUMERIC'
                )
            );
        } elseif ($sim_muc_gia == '100') {
            array_push($filter_query, array(
                'key' => 'gia_ban',
                'value' => '100000000',
                'compare' => '>',
                'type' => 'NUMERIC'
                )
            );
        } else {
            $muc_gia = explode(",", $sim_muc_gia);
            $muc_gia[0] = (int) $muc_gia[0]."000000";
            $muc_gia[1] = (int) $muc_gia[1]."000000";
            $filter_query['relation'] = 'AND';
            array_push($filter_query, array(
                'key' => 'gia_ban',
                'value' => $muc_gia[0],
                'compare' => '>=',
                'type' => 'NUMERIC'
                )
            );
            array_push($filter_query, array(
                'key' => 'gia_ban',
                'value' => $muc_gia[1],
                'compare' => '<=',
                'type' => 'NUMERIC'
                )
            );
        }

        // SẮP XẾP
        if ($sim_sap_xep != 0) {
            $wp_query->set( 'orderby', 'gia_ban' );
            if ($sim_sap_xep == 1) {
                $wp_query->set( 'order', 'ASC' );
            } elseif ($sim_sap_xep == 2) {
                $wp_query->set( 'order', 'DESC' );
            }
        }

        $meta_query = $wp_query->get( 'meta_query' );
        $meta_query[] = $filter_query;
        $wp_query->set( 'meta_query', $meta_query );

        //MẠNG DI ĐỘNG
        $filter_query2 = array();
        if ($sim_mang_di_dong != 'all') {
            $tax_query = $wp_query->get( 'tax_query' );

            $obj = get_queried_object();

            if ($obj) {
                $filter_query['relation'] = 'AND';
                array_push($filter_query2, array(
                    'taxonomy'  => $obj->taxonomy,
                    'field'     => 'slug',
                    'terms'     => $obj->slug,
                    'operator'  => 'IN'
                    )
                );
            }

            array_push($filter_query2, array(
                'taxonomy'  => 'mang_sim',
                'field'     => 'name',
                'terms'     => $sim_mang_di_dong,
                'operator'  => 'IN'
                )
            );

            $tax_query[] = $filter_query2;
            $wp_query->set( 'tax_query', $tax_query );
        }
    }
}



// ONLY SIMSO CUSTOM TYPE POSTS
add_filter('manage_simso_posts_columns', 'ST4_columns_head_simso', 10);
add_action('manage_simso_posts_custom_column', 'ST4_columns_content_simso', 10, 2);

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ST4_columns_head_simso($defaults) {
    $defaults['gia_ban'] = 'Giá bán';
    $defaults['mang_sim'] = 'Mạng di động';
    $defaults['loai_sim'] = 'Loại Sim';
    $defaults['nam_sinh_sim'] = 'Sim Năm Sinh';
    return $defaults;
}
function ST4_columns_content_simso($column_name, $post_ID) {
    if ($column_name == 'gia_ban') {
        $gia_ban = number_format((int) get_post_meta( $post_ID, 'gia_ban', true ), 0,'.', ' ');
        echo $gia_ban.' đ';

    }

    if ($column_name == 'mang_sim') {
        $terms = wp_get_post_terms( $post_ID, 'mang_sim' );
        foreach ($terms as $term) {
            echo '<a href="#">'.$term->name.'</a><br>';
        }
    }

    if ($column_name == 'loai_sim') {
        $terms = wp_get_post_terms( $post_ID, 'loai_sim' );
        foreach ($terms as $term) {
            echo '<a href="#">'.$term->name.'</a><br>';
        }
    }
    if ($column_name == 'nam_sinh_sim') {
        $terms = wp_get_post_terms( $post_ID, 'nam_sinh_sim' );
        foreach ($terms as $term) {
            echo '<a href="#">'.$term->name.'</a><br>';
        }
    }
}

//FILTER SIM
/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
    global $typenow;
    $post_type = 'simso'; // change to your post type
    $taxonomy  = 'loai_sim'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Xem tất cả {$info_taxonomy->label}"),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'hide_empty'      => true,
            ));
    };
    $taxonomy  = 'mang_sim'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Xem tất cả {$info_taxonomy->label}"),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'hide_empty'      => true,
            ));
    };
    $taxonomy  = 'nam_sinh_sim'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Xem tất cả {$info_taxonomy->label}"),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'hide_empty'      => true,
            ));
    };
}

/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
    global $pagenow;
    $post_type = 'simso'; // change to your post type
    $taxonomy  = 'loai_sim'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }

    $taxonomy  = 'mang_sim'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
    $taxonomy  = 'nam_sinh_sim'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}


//Custom Contact Form 7 shortcode
add_action( 'wpcf7_init', 'custom_add_shortcode_simso' );

function custom_add_shortcode_simso() {
    wpcf7_add_form_tag( 'sim_meta', 'custom_simso_shortcode_handler' );
}

function custom_simso_shortcode_handler( $tag ) {
    global $post;
    $sim_meta = get_post_meta( $post->ID );
    $sim_so = $sim_meta['sim_so'][0];
    $gia_ban = number_format($sim_meta['gia_ban'][0], 0,'.', ' ');
    $terms = wp_get_post_terms( $post->ID, 'mang_sim' );
    $mang_di_dong = '';
    foreach ($terms as $term) {
        $mang_di_dong .= $term->name;
    }

    $sim_input = '<input type="hidden" name="sim_so" id="sim_so" class="form-control" value="'.$sim_so.'">';
    $sim_input .= '<input type="hidden" name="gia_ban" id="gia_ban" class="form-control" value="'.$gia_ban.' đ">';
    $sim_input .= '<input type="hidden" name="mang_di_dong" id="mang_di_dong" class="form-control" value="'.$mang_di_dong.'">';

    return $sim_input;
}

// Hook for additional special mail tag
add_filter( 'wpcf7_special_mail_tags', 'wti_special_mail_tag', 20, 3 );

function wti_special_mail_tag( $output, $name, $html )
{
    // For backwards compatibility
    $name = preg_replace( '/^wpcf7\./', '_', $name );

    if ( 'sim_so' == $name ) {
        global $post;
        $output = get_post_meta( $post->ID, 'sim_so', true );

    } elseif ( 'gia_ban' == $name ) {
        global $post;
        $output = get_post_meta( $post->ID, 'gia_ban', true );
    } elseif ( 'mang_di_dong' == $name ) {
        global $post;
        $terms = wp_get_post_terms( $post->ID, 'mang_sim' );
        foreach ($terms as $term) {
            $mang_di_dong .= $term->name;
        }
        $output = $mang_di_dong;
    }

    return $output;
}


