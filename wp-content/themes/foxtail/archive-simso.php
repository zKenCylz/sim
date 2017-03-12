<?php
/**
 * The template for displaying archive-simso pages.
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

                    <h1 class="archive-title"><?php the_archive_title() ?></h1>

                    <div class="posts-with-thumbnail posts-standard">

                        <?php
                        global $wp_query;
                        $obj = get_queried_object();
                        $sim_query = $wp_query->query;
                        var_dump($sim_query);
                        // var_dump($obj);
                        if($obj->taxonomy != 'category' ){
                            if ( is_tax() ) {
                                $permalink = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                            }
                            elseif( is_post_type_archive() ) {
                                $permalink = get_post_type_archive_link( get_query_var('post_type') );
                            }
                            elseif (is_search()) {
                                $s = isset($_GET['s']) ? $_GET['s'] : "";
                                $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : "";
                                $permalink = get_home_url().'/?s='.$s.'&post_type='.$post_type;
                            }
                            else {
                                $permalink = get_permalink();
                            }
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
                                    if (have_posts()):
                                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $post_per_page = $wp_query->query_vars['posts_per_page'];
                                    if ($paged == 1) {
                                        $i = 1;
                                    } else {
                                        $i = ($paged-1)*$post_per_page + 1;
                                    }
                                    while (have_posts()):
                                        the_post();
                                    include( locate_template( 'content-sim-archive.php', false, false ) );
                                    $i++;
                                    endwhile;

                                    echo "</tbody></table>";

                                    foxtail_pagination();
                                    else:
                                        echo '<tr><td colspan="6"><p>Không tìm thấy sim nào!!</p></td></tr>';
                                    echo "</tbody></table>";
                                    endif;
                                } else {
                                    if (have_posts()):
                                        while (have_posts()):
                                            the_post();
                                        get_template_part('content', get_post_format());
                                        endwhile;
                                        foxtail_pagination();
                                        else:
                                            get_template_part('content', get_post_format());
                                        endif;
                                    }

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
