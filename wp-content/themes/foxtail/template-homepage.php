<?php
/**
 * The template for displaying the homepage.
 * Template name: Homepage
 */

get_header(); ?>

<main class="main main-archive">
    <div class="container">
        <div class="wrap-bg">
            <div class="row">
                <aside class="sidebar col-md-2 col-sm-2 col-xs-12" role="complementary">

                    <?php get_sidebar('left') ?>

                </aside>
                <section class="content col-md-8 col-sm-8 col-xs-12" role="main">

                    <?php if ( function_exists('yoast_breadcrumb') )
                    {yoast_breadcrumb('<div id="breadcrumbs">','</div>');} ?>

                    <?php get_search_form(); ?>

                    <h1 class="archive-title">Sim số đẹp</h1>

                    <div class="posts-with-thumbnail posts-standard">

                        <?php

                        $permalink = get_permalink();
                        $obj = get_term_by( 'slug', 'sim-vip', 'loai_sim' );
                        $sim_do_dai = isset($_GET['sim_do_dai']) ? $_GET['sim_do_dai'] : 'all';
                        $sim_muc_gia = isset($_GET['sim_muc_gia']) ? $_GET['sim_muc_gia'] : 'all';
                        if ($obj->taxonomy == "mang_sim") {
                            $sim_mang_di_dong = $obj->name;
                        } else {
                            $sim_mang_di_dong = isset($_GET['sim_mang_di_dong']) ? $_GET['sim_mang_di_dong'] : 'all';
                        }
                        $sim_sap_xep = isset($_GET['sim_sap_xep']) ? $_GET['sim_sap_xep'] : '0';
                        ?>
                        <form action="<?php echo $permalink; ?>" method="GET" role="form" class="form-inline">
                            <div class="form-group">
                                <select name="sim_do_dai" id="inputSim_do_dai" class="form-control" required="required">
                                    <option value="all" <?php if ($sim_do_dai=='all') {echo "selected";} ?>>10/11 số</option>
                                    <option value="10" <?php if ($sim_do_dai=='10') {echo "selected";} ?>>10 số</option>
                                    <option value="11" <?php if ($sim_do_dai=='11') {echo "selected";} ?>>11 số</option>
                                </select>
                                <select name="sim_muc_gia" id="inputSim_muc_gia" class="form-control" required="required">
                                    <option value="all" <?php if ($sim_muc_gia=='all') {echo "selected";} ?>>Mọi mức giá</option>
                                    <option value="1" <?php if ($sim_muc_gia=='1') {echo "selected";} ?>>Dưới 1 triệu</option>
                                    <option value="1,2" <?php if ($sim_muc_gia=='1,2') {echo "selected";} ?>>1 - 2 triệu</option>
                                    <option value="2,3" <?php if ($sim_muc_gia=='2,3') {echo "selected";} ?>>2 - 3 triệu</option>
                                    <option value="3,5" <?php if ($sim_muc_gia=='3,5') {echo "selected";} ?>>3 - 5 triệu</option>
                                    <option value="5,8" <?php if ($sim_muc_gia=='5,8') {echo "selected";} ?>>5 - 8 triệu</option>
                                    <option value="8,10" <?php if ($sim_muc_gia=='8,10') {echo "selected";} ?>>8 - 10 triệu</option>
                                    <option value="10,15" <?php if ($sim_muc_gia=='10,15') {echo "selected";} ?>>10 - 15 triệu</option>
                                    <option value="15,20" <?php if ($sim_muc_gia=='15,20') {echo "selected";} ?>>15 - 20 triệu</option>
                                    <option value="20,50" <?php if ($sim_muc_gia=='20,50') {echo "selected";} ?>>20 - 50 triệu</option>
                                    <option value="50,100" <?php if ($sim_muc_gia=='50,100') {echo "selected";} ?>>50 - 100 triệu</option>
                                    <option value="100" <?php if ($sim_muc_gia=='100') {echo "selected";} ?>>Trên 100 triệu</option>
                                </select>
                                <select <?php if ($obj->taxonomy != 'mang_sim') { echo 'name="sim_mang_di_dong" id="inputSim_mang_di_dong" required="required"'; } ?> class="form-control" >
                                    <?php
                                    if ($obj->taxonomy == 'mang_sim') {
                                        echo '<option value="'.$obj->name.'" selected>'.$obj->name.'</option>';
                                    } else {
                                        $selected = '';
                                        if ($sim_mang_di_dong == 'all') { $selected = "selected"; }
                                        echo '<option value="all" '.$selected.' >Mọi mạng</option>';

                                        $args = array(
                                            'taxonomy' => 'mang_sim',
                                            'parent'   => 0,
                                            'hide_empty' => false,
                                            );
                                        $terms = get_terms( $args );

                                        foreach ($terms as $term) {
                                            $selected = '';
                                            if ($sim_mang_di_dong == $term->name) { $selected = "selected"; }
                                            echo '<option value="'.$term->name.'" '.$selected.' >'.$term->name.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <select name="sim_sap_xep" id="inputSim_sap_xep" class="form-control" required="required">
                                    <option value="0" <?php if ($sim_sap_xep=='0') {echo "selected";} ?>>Sắp xếp</option>
                                    <option value="1" <?php if ($sim_sap_xep=='1') {echo "selected";} ?>>Giá thấp đến cao</option>
                                    <option value="2" <?php if ($sim_sap_xep=='2') {echo "selected";} ?>>Giá cao đến thấp</option>
                                </select>
                            </div>

                            <button type="submit" name="filter" class="btn btn-primary">Lọc</button>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Số Sim</th>
                                    <th>Giá bán</th>
                                    <th>Mạng di động</th>
                                    <th>Loại sim</th>
                                    <th>Mua sim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $args = array(
                                    'post_type' => 'simso',
                                    'post_status' => 'publish',
                                    'meta_key' => 'gia_ban',
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC',
                                    );

                                $filter_query = array();
                                if ($sim_mang_di_dong != 'all') {
                                    $args['tax_query'] = array( array('taxonomy' => 'mang_sim', 'field' => 'name','terms' => $sim_mang_di_dong) );
                                }

                                $filter_query['relation'] = 'AND';
                                //ĐỘ DÀI
                                if ($sim_do_dai == '10') {
                                    $filter_query['relation'] = 'AND';
                                    array_push($filter_query, array('key' => 'sim_so', 'value' => '999999999', 'compare' => '<=', 'type' => 'NUMERIC'));
                                    array_push($filter_query, array('key' => 'sim_so','value' => '900000000','compare' => '>=','type' => 'NUMERIC'));
                                } elseif ($sim_do_dai == '11') {
                                    $filter_query['relation'] = 'AND';
                                    array_push($filter_query, array('key' => 'sim_so','value' => '1000000000','compare' => '>=','type' => 'NUMERIC'));
                                    array_push($filter_query, array('key' => 'sim_so','value' => '1699999999','compare' => '<=','type' => 'NUMERIC'));
                                }

                                //MỨC GIÁ
                                if ($sim_muc_gia == 'all') {
                                    array_push($filter_query, array('key' => 'gia_ban','value' => '0','compare' => '>=','type' => 'NUMERIC'));
                                } elseif ($sim_muc_gia == '1') {
                                    array_push($filter_query, array('key' => 'gia_ban','value' => '1000000','compare' => '<','type' => 'NUMERIC'));
                                } elseif ($sim_muc_gia == '100') {
                                    array_push($filter_query, array('key' => 'gia_ban','value' => '100000000','compare' => '>','type' => 'NUMERIC'));
                                } else {
                                    $muc_gia = explode(",", $sim_muc_gia);
                                    $muc_gia[0] = (int) $muc_gia[0]."000000";
                                    $muc_gia[1] = (int) $muc_gia[1]."000000";
                                    $filter_query['relation'] = 'AND';
                                    array_push($filter_query, array('key' => 'gia_ban','value' => $muc_gia[0],'compare' => '>=','type' => 'NUMERIC'));
                                    array_push($filter_query, array('key' => 'gia_ban','value' => $muc_gia[1],'compare' => '<=','type' => 'NUMERIC'
                                        )
                                    );
                                }

                                // SẮP XẾP
                                if ($sim_sap_xep != 0) {
                                    $args['meta_key'] = 'gia_ban';
                                    $args['orderby'] = 'meta_value_num';
                                    if ($sim_sap_xep == 1) {
                                        $args['order'] = 'ASC';
                                    } elseif ($sim_sap_xep == 2) {
                                        $args['order'] = 'DESC';
                                    }
                                }
                                $args['meta_query'] = array( $filter_query );
                                //Phân trang
                                $paged = get_query_var('page') ? get_query_var('page') : 1;
                                $post_per_page = get_query_var('posts_per_page');
                                $args['paged'] = $paged;

                                // =======================
                                $query = new WP_Query( $args );
                                // Pagination fix
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $query;

                                if ($query->have_posts()):
                                    if ($paged == 1) {
                                        $i = 1;
                                    } else {
                                        $i = ($paged-1)*$post_per_page + 1;
                                    }
                                    while ($query->have_posts()):
                                        $query->the_post();
                                    include( locate_template( 'content-sim-archive.php', false, false ) );
                                    $i++;
                                    endwhile;

                                    echo "</tbody></table>";

                                    foxtail_pagination();
                                    else:
                                        echo '<tr><td colspan="6"><p>Không tìm thấy sim nào!!</p></td></tr>';
                                    echo "</tbody></table>";
                                    endif;
                                    // Reset postdata
                                    wp_reset_postdata();
                                    // Reset main query object
                                    $wp_query = NULL;
                                    $wp_query = $temp_query;
                                    ?>
                                </div>
                                <div id="chucmayman">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/chucmayman.gif" alt="">
                                </div>                </section>
                                <aside class="sidebar col-md-2 col-sm-2 col-xs-12" role="complementary">

                                   <?php get_sidebar('right') ?>

                               </aside>
                           </div>
                       </div>
                   </div>
               </main><!--/ main -->

               <?php get_footer(); ?>
