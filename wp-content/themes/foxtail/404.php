<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<main class="main main-404">
	<div class="container text-center">

		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<div id="breadcrumbs">','</div>');} ?>

		<h1 class="page-title"><?php esc_html_e( '404. Page not found!', 'foxtail' ); ?></h1>

		<img class="gap" src="<?php echo get_template_directory_uri() ?>/img/404.jpg" alt="404-page">

		<p><?php esc_html_e('It seem like the content you look is not exist', 'foxtail') ?></p>

		<p><?php esc_html_e('Try to search in website:', 'foxtail') ?></p>

		<?php //get_search_form() ?>

		<p><?php esc_html_e('Or return to', 'foxtail') ?> <a href="<?php echo home_url('/') ?>"><?php esc_html_e('Home page') ?></a></p>

	</div>
</main>

<?php get_footer(); ?>