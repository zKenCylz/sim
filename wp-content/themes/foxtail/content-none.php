<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
?>

<section class="no-results not-found">
	<h3 class="page-title title"><?php esc_html_e('Nothing found!', 'foxtail') ?></h3>
	<div class="page-content">

		<p><?php esc_html_e('Try to search in website:', 'foxtail') ?></p>

		<?php //get_search_form() ?>

		<p><?php esc_html_e('Or return to', 'foxtail') ?> <a href="<?php echo home_url('/') ?>"><?php esc_html_e('Home page') ?></a></p>

	</div><!-- .page-content -->
</section><!-- .no-results -->
