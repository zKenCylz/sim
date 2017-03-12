<?php
/**
 * Default Content
 */
?>

<article class="clearfix post" role="article" itemscope="" itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

	<?php foxtail_thumbnail('post-thumbnail') ?>

	<h3 class="post-title title" itemprop="name">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>

</article>