<?php

/**
 * Visual Composer additional custom shortcode
 */

add_shortcode( 'foxtail_blog', 'foxtail_blog' );
function foxtail_blog( $atts )
{
	extract( shortcode_atts( array(
		'cat' => 0,
		'posts_per_page' => 5,
		'title' => ''
	), $atts ) );

	if ( $cat == 0) return;
	query_posts( array(
		'post_type' => 'post',
		'cat' => $cat,
		'posts_per_page' => $posts_per_page
	) );

	ob_start();
	echo '<div class="blog-small">';
	echo '<h3 class="blog-title">' . $title . '</h3>';
	echo '<div class="content">';

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part('content', 'small');
		}
	}

	echo '</div>';
	echo '</div>';
	$str = ob_get_clean();

	wp_reset_query();

	return $str;
}

add_action( 'vc_before_init', 'foxtail_blog_vc_map' );
function foxtail_blog_vc_map()
{
	$categories = get_categories();
	$cat_array = array();
	foreach ( $categories as $item ) {
		$cat_array[$item->name] = $item->term_id;
	}

	vc_map( array(
		'name' => __( 'Foxtail Blog', 'foxtail' ),
		'base' => 'foxtail_blog',
		'class' => '',
		'category' => __( 'Content', 'foxtail'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Title', 'foxtail' ),
				'param_name' => 'title',
				'value' => '',
				'description' => __( 'Blog title', 'foxtail' )
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Posts per page', 'foxtail' ),
				'param_name' => 'posts_per_page',
				'value' => '5',
				'description' => __( 'Posts per page', 'foxtail' )
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Category', 'foxtail' ),
				'param_name' => 'cat',
				'value' => $cat_array,
				'description' => __( 'Posts per page', 'foxtail' )
			)
		)
	) );
}