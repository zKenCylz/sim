<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<main class="main main-single">
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
					<?php
					if (have_posts()):
						while (have_posts()):
							the_post();
                            $post_type = get_post_type();
                            if ($post_type == 'simso') {
                                get_template_part('content', 'simso');
                            } else {
                                get_template_part('content', 'single');
                            }
						endwhile;
						wp_pagenavi();
					else:
						get_template_part('content', 'none');
					endif;
					?>

				</section>
				<aside class="sidebar col-md-2 col-sm-2 col-xs-12" role="complementary">

                    <?php get_sidebar('right') ?>

                </aside>
			</div>
		</div>
	</div>
</main><!--/ main -->

<?php get_footer(); ?>