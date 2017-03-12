<?php
/**
 * The template for displaying archive pages.
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
                        if (have_posts()):
                            while (have_posts()):
                                the_post();
                            get_template_part('content', get_post_format());
                            endwhile;
                            foxtail_pagination();
                            else:
                                get_template_part('content', get_post_format());
                            endif;

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
