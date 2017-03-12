<?php

/**
 * Register widgets
 */
add_action('widgets_init', 'foxtail_register_widgets');

function foxtail_register_widgets()
{
   register_widget('Foxtail_SimTax_Cat_Widget');
   register_widget('Foxtail_Recent_Posts_Widget');
//    register_widget('Foxtail_Most_View_Widget');
   register_widget('Foxtail_Customer_Widget');
}

/**
 * Class Foxtail_SimTax_Cat_Widget
 */

if (!class_exists('Foxtail_SimTax_Cat_Widget'))
{
    class Foxtail_SimTax_Cat_Widget extends WP_Widget {

        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname' => 'foxtail-simtax-cat-widget', 'description' => 'Foxtail SimTax Cat Widget, simtax category' );
            /* Widget control settings. */
            $control_ops = array( 'id_base' => 'foxtail-simtax-cat-widget' );
            /* Create the widget. */
            parent::__construct('foxtail-simtax-cat-widget', 'Foxtail SimTax Cat Widget', $widget_ops, $control_ops);
        }

        function form( $instance ) {
            $simtax_list = get_object_taxonomies( 'simso' );

            $default = array(
                'title' => __( '', 'foxtail'),
                'simtax' => $simtax_list[0]
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $title = esc_attr($instance['title']);
            $simtax = esc_attr($instance['simtax']);

            echo '<p>'.__('Widget title', 'foxtail').' <input id="simtax_title" type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
            echo '<p>Chọn danh mục:';
            echo '<select id="simtax_cat" name="'.$this->get_field_name('simtax').'">';

            for ($i=0; $i < count($simtax_list); $i++) {
                $simtax_name = get_taxonomy( $simtax_list[$i] )->label;
                if ($simtax == $simtax_list[$i]) {
                    echo '<option value="'.$simtax_list[$i].'" selected>'.$simtax_name.'</option>';
                } else {
                    echo '<option value="'.$simtax_list[$i].'">'.$simtax_name.'</option>';
                }
            }
            if ($simtax == 'muc_gia_sim') {
                echo '<option value="muc_gia_sim" selected>Mức Giá Sim</option>';
            } else {
                echo '<option value="muc_gia_sim">Mức Giá Sim</option>';
            }
            echo '</select></p>';

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['simtax'] = strip_tags($new_instance['simtax']);

            return $instance;
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $simtax = $instance['simtax'];

            echo $before_widget; ?>

            <header class="widget-header"><h3 class="widget-title"><span><?= $title ?></span></h3></header>

            <?php
            if ($simtax=='muc_gia_sim') {
                ?>
                <ul class="posts-small-thumb posts-with-thumbnail">
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=1">Sim dưới 1 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=1,2">Sim giá 1 - 2 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=2,3">Sim giá 2 - 3 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=3,5">Sim giá 3 - 5 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=5,8">Sim giá 5 - 8 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=8,10">Sim giá 8 - 10 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=10,15">Sim giá 10 - 15 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=15,20">Sim giá 15 - 20 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=20,50">Sim giá 20 - 50 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=50,100">Sim giá 50 - 100 triệu</a></li>
                    <li class="clearfix post"><a href="<?php echo get_site_url(); ?>?filter&sim_muc_gia=100">Sim trên 100 triệu</a></li>
                </ul>
                <?php
            } else {
                $args = array(
                    'taxonomy' => $simtax,
                    'parent'   => 0,
                    'hide_empty' => false,
                    );

                $terms = get_terms( $args );
                ?>

                <ul class="posts-small-thumb posts-with-thumbnail">
                    <?php
                    foreach ($terms as $term) {
                        $term_link = get_term_link( $term );
                    // If there was an error, continue to the next term.
                        if ( is_wp_error( $term_link ) ) {
                            continue;
                        }
                        echo '<li class="clearfix post"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
                    }
                    ?>
                </ul>

                <?php
            }
            echo $after_widget;
        }

    }
    // end class
}

/**
 * Class Foxtail_Recent_Posts_Widget
 */

if (!class_exists('Foxtail_Recent_Posts_Widget'))
{
    class Foxtail_Recent_Posts_Widget extends WP_Widget {

        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname' => 'foxtail-recent-posts-widget', 'description' => 'Foxtail Recent Posts Widget, recent posts with thumbnail' );
            /* Widget control settings. */
            $control_ops = array( 'id_base' => 'foxtail-recent-posts-widget' );
            /* Create the widget. */
            parent::__construct('foxtail-recent-posts-widget', 'Foxtail Recent Posts Widget', $widget_ops, $control_ops);
        }

        function form( $instance ) {

            $default = array(
                'title' => __('Recent Posts', 'foxtail'),
                'post_type' => 'post',
                'post_number' => 5,
                'category_id' => ''
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $title = esc_attr($instance['title']);
            $post_type = esc_attr($instance['post_type']);
            $post_number = esc_attr($instance['post_number']);
            $category_id = esc_attr($instance['category_id']);

            echo '<p>'.__('Widget title', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
            echo '<p>'.__('Post type', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('post_type').'" value="'.$post_type.'" /></p>';
            echo '<p>'.__('Number of posts', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" /></p>';
            echo '<p>'.__('Category id', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('category_id').'" value="'.$category_id.'" /></p>';

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['post_type'] = strip_tags($new_instance['post_type']);
            $instance['post_number'] = strip_tags($new_instance['post_number']);
            $instance['category_id'] = strip_tags($new_instance['category_id']);

            return $instance;
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $post_type = $instance['post_type'];
            $post_number = $instance['post_number'];
            $category_id = $instance['category_id'];

            echo $before_widget; ?>

            <header class="widget-header"><h3 class="widget-title"><span><?= $title ?></span></h3></header>

            <?php
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => $post_number
                );

            if ($category_id != '') $args['cat'] = $category_id;
            query_posts( $args );
            ?>

            <ul class="posts-small-thumb posts-with-thumbnail">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <li class="clearfix post">
                        <?php foxtail_thumbnail('thumbnail') ?>
                        <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                        <div class="post-meta"><?php echo get_the_category_list(', ') ?></div>
                    </li>

                <?php endwhile; endif; ?>
                <?php wp_reset_query() ?>

            </ul>

            <?php echo $after_widget;
        }

    }
    // end class
}

/**
 * Class Foxtail_Most_View_Widget
 */

if (!class_exists('Foxtail_Most_View_Widget'))
{
    class Foxtail_Most_View_Widget extends WP_Widget {

        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname' => 'foxtail-most-view-widget', 'description' => 'Foxtail Most View Widget' );
            /* Widget control settings. */
            $control_ops = array( 'id_base' => 'foxtail-most-view-widget' );
            /* Create the widget. */
            parent::__construct('foxtail-most-view-widget', 'Foxtail Most View Widget', $widget_ops, $control_ops);
        }

        function form( $instance ) {

            $default = array(
                'title' => __('Most View', 'foxtail'),
                'post_number' => 5
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $title = esc_attr($instance['title']);
            $post_number = esc_attr($instance['post_number']);

            echo '<p>'.__('Widget title', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
            echo '<p>'.__('Post number', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" /></p>';
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['post_number'] = strip_tags($new_instance['post_number']);

            return $instance;
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $post_number = $instance['post_number'];

            echo $before_widget; ?>

            <header class="widget-header"><h3 class="widget-title"><span><?= $title ?></span></h3></header>
            <div class="widget-content">

                <?php
                $args = array(
                    'post_type' => array('post'),
                    'posts_per_page' => $post_number,
                    'meta_key' => 'foxtail_post_views_count',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                    );
                query_posts( $args );
                ?>

                <ul class="list-unstyled posts-with-thumbnail most-views">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <li class="clearfix post">
                            <a class="post-thumbnail" href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('small-thumb') ?>
                            </a>
                            <a href="<?php the_permalink() ?>"><h3 class="ellipsis title"><?php the_title() ?></h3></a>
                            <p class="category">

                            </p>
                            <p class="date-view">
                                <span class="date"><i class="fa fa-calendar"></i> <?php the_time('d/m/Y') ?></span>
                                <span class="view"><i class="fa fa-headphones"></i> <?php echo foxtail_get_post_views(get_the_ID()) ?></span>
                            </p>
                        </li>

                    <?php endwhile; endif; ?>
                    <?php wp_reset_query() ?>

                </ul>

            </div>

            <?php echo $after_widget;
        }

    }
    // end class
}


/**
 * Class Foxtail_Customer_Widget
 */

if (!class_exists('Foxtail_Customer_Widget'))
{
    class Foxtail_Customer_Widget extends WP_Widget {

        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname' => 'foxtail-customer-widget', 'description' => 'Foxtail Customers Say Widget' );
            /* Widget control settings. */
            $control_ops = array( 'id_base' => 'foxtail-customer-widget' );
            /* Create the widget. */
            parent::__construct('foxtail-customer-widget', 'Foxtail Customer Widget', $widget_ops, $control_ops);
        }

        function form( $instance ) {

            $default = array(
                'title' => __('Customer Comments', 'foxtail')
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $title = esc_attr($instance['title']);

            echo '<p>'.__('Widget title', 'foxtail').' <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);

            return $instance;
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );

            echo $before_widget; ?>

            <header class="widget-header"><h3 class="widget-title"><span><?= $title ?></span></h3></header>
            <div class="widget-content">

                <?php
                $args = array(
                    'post_type' => 'customer',
                    'posts_per_page' => -1
                    );
                query_posts( $args );
                ?>

                <ul class="list-unstyled posts-with-thumbnail customers">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <li class="clearfix post">
                            <h3 class="title"><?php the_title() ?></h3>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('small-thumb') ?>
                            </div>
                            <div class="info">
                                <div class="content">
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </li>

                    <?php endwhile; endif; wp_reset_query() ?>

                </ul>
            </div>

            <?php echo $after_widget;
        }

    }
    // end class
}