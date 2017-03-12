<?php
/**
 * The template for displaying the footer.
 */
global $foxtail_options;
?>

<footer id="footer">
    <div class="container">

		<?php dynamic_sidebar( 'sidebar-footer' ) ?>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'sidebar-footer-1' ) ?>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'sidebar-footer-2' ) ?>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'sidebar-footer-3' ) ?>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'sidebar-footer-4' ) ?>
            </div>
        </div>
    </div>
</footer>

<?php if ( isset($foxtail_options['show-aside-banner']) && $foxtail_options['show-aside-banner'] == 1 ): ?>

	<div id="aside-banner">
		<div class="banner-container" style="margin-top: <?php echo $foxtail_options['aside-banner-margin-top'] ?>px">
			<div class="left banner">
				<a href="<?php echo $foxtail_options['left-banner-link'] ?>" target="_blank">
					<img src="<?php echo $foxtail_options['left-banner']['url'] ?>" alt="<?php echo $foxtail_options['left-banner-link'] ?>" />
				</a>
			</div>
			<div class="right banner">
				<a href="<?php echo $foxtail_options['right-banner-link'] ?>" target="_blank">
					<img src="<?php echo $foxtail_options['right-banner']['url'] ?>" alt="<?php echo $foxtail_options['right-banner-link'] ?>" />
				</a>
			</div>
		</div>
	</div>

<?php endif; ?>

<div id="up-button">
    <i class="fa fa-angle-up"></i>
</div>

<?php echo isset($foxtail_options['footer-code']) ? $foxtail_options['footer-code']: ""; ?>

<?php wp_footer(); ?>

</body>
</html>
