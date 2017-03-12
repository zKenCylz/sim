<?php
/**
 * Content For Single Audio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="" itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
	<h1 class="post-title title page-title" itemprop="name">
		<?php the_title(); ?>
	</h1>

	<div class="post-content"><?php the_content() ?></div>
	<div class="tags">
		<i class="fa fa-tags"></i> Tags: <?php echo get_the_tag_list('', ', ', '') ?>
	</div>

	<?php //foxtail_comment_facebook(get_the_permalink()) ?>

	<div class="related-posts box home-blog">
		<header class="box-header">
			<h3 class="box-title">Bài viết liên quan</h3>
		</header>
		<section class="box-content">
			<div class="row posts-with-thumbnail posts-small-thumb">

				<?php $related_posts = foxtail_get_related_posts(get_the_ID()); ?>

				<?php
				if (!empty($related_posts)) if ($related_posts->have_posts()):
					$i = 0;
					while($related_posts->have_posts()):
						$i++;
						$related_posts->the_post();
						get_template_part('content', 'home');
						if ($i % 2 == 0) echo '<div class="col-xs-12 hidden-xs"></div>';
					endwhile;
				endif;
				?>

			</div>
		</section>
	</div>
</article><!-- #post-## -->