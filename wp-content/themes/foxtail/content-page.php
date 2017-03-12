<?php
/**
 * Content For Page
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="" itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
	<h1 class="post-title title" itemprop="name">
		<?php the_title(); ?>
	</h1>

	<div class="post-content"><?php the_content() ?></div>

</article><!-- #post-## -->