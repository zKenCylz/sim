<?php
/**
 * The template for displaying the homepage.
 * Template name: Full width
 */

get_header();
global $foxtail_options;
if (have_posts()) while(have_posts()):
    the_post(); ?>
<div class="container">
	<div class="wrap">

		<?php the_content() ?>

	</div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>