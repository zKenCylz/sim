<?php
/**
 * Content for blog in home
 */
?>

<div class="blog-item">
	<article class="post clearfix">
		<a class="post-thumbnail" href="<?php the_permalink() ?>">
			<?php the_post_thumbnail('small-thumb') ?>
		</a>
		<a href="<?php the_permalink() ?>"><h3 class="post-title title"><?php the_title() ?></h3></a>
		<div class="post-date"><i class="fa fa-calendar"></i> <?php the_time( 'd-m-Y' ) ?></div>
	</article>
</div>