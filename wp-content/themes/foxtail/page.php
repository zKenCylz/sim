<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<main class="main main-single main-page">
	<div class="container">
		<div class="wrap-bg">
			<div class="row">
				<aside class="sidebar col-md-2 col-sm-2 col-xs-12" role="complementary">

					<?php get_sidebar("left") ?>

				</aside>
				<section class="content col-md-8 col-sm-8 col-xs-12" role="main">
					<?php if ( function_exists('yoast_breadcrumb') )
					{yoast_breadcrumb('<div id="breadcrumbs">','</div>');} ?>
                    <?php get_search_form(); ?>
					<?php
					if (have_posts()):

						while (have_posts()):
							the_post();
                            global $post;
                            $post_slug = $post->post_name;
                            if ($post_slug == 'sim-phong-thuy') {
                                get_template_part('content', 'sim-phong-thuy');
                            } else {
                                get_template_part('content', 'page');
                            }
						endwhile;
						wp_pagenavi();
					else:
						get_template_part('content', 'none');
					endif;
					?>
                    <div id="chucmayman">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/chucmayman.gif" alt="">
                    </div>
				</section>
				<aside class="sidebar col-md-2 col-sm-2 col-xs-12" role="complementary">

					<?php get_sidebar("right") ?>

				</aside>
			</div>
		</div>
	</div>
</main><!--/ main -->

<?php get_footer(); ?>