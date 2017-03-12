jQuery(document).ready(function() {
    // add fix top navabar
    jQuery(window).on('scroll', function () {
        var scrollTop = jQuery(window).scrollTop();
        if (scrollTop > 72) {
            jQuery("#up-button").stop().fadeIn(300);
            //jQuery("#main-nav").addClass("navbar-fixed-top");
        }
        else {
            jQuery("#up-button").stop().fadeOut(300);
            //jQuery("#main-nav").removeClass("navbar-fixed-top");
        }
    });

    // up to top
    jQuery("#up-button").click(function () {
        jQuery("html, body").animate({scrollTop: 0}, 500);
    });

    jQuery("#main-nav-menu > .menu-item-has-children").hover(function() {
        jQuery(this).find("ul.sub-menu").stop().slideDown(300);
    }, function() {
        jQuery(this).find("ul.sub-menu").stop().slideUp(300);
    });

	is_show_nav_mobile = false;
	jQuery("#nav-mobile-toggle").click(function() {
		if ( !is_show_nav_mobile ) {
			is_show_nav_mobile = true;
			jQuery("#nav-mobile").stop().slideDown(300);
		}
		else {
			is_show_nav_mobile = false;
			jQuery("#nav-mobile").stop().slideUp(300);
		}
	});

    jQuery(document).on('mouseenter', '#header-minicart', function () {
        jQuery('#header-minicart .minicart-dropdown').stop().slideDown();
    });
    jQuery(document).on('mouseleave', '#header-minicart', function () {
        jQuery('#header-minicart .minicart-dropdown').stop().slideUp();
    });

    // // project carousel
    // jQuery("#onsale-products > .woocommerce > .row").owlCarousel({
    //     items: 4,
    //     responsiveClass:true,
    //     responsive:{
    //         0:{
    //             items:1
    //         },
    //         767:{
    //             items:2
    //         },
    //         991:{
    //             items:3
    //         }
    //     }
    // });

    // carousel control
    // jQuery("#project-control-prev").click(function() {
    //     jQuery("#project-carousel").find(".owl-prev").trigger("click");
    // });
    // jQuery("#project-control-next").click(function() {
    //     jQuery("#project-carousel").find(".owl-next").trigger("click");
    // });

});