jQuery(document).ready(function() {
// single product images
    jQuery(".f-product-image .images .thumbnails > a:first-child").addClass("active");

    jQuery(".f-product-image .images .thumbnails > a").click(function(e) {
        e.preventDefault();
        var img_src = jQuery(this).attr("href");
        var src_set = jQuery(this).find("img").attr("srcset");
        jQuery(".f-product-image .images .thumbnails > a").removeClass("active");
        jQuery(this).addClass("active");

        var main_img = jQuery(".f-product-image .images .woocommerce-main-image");

        main_img.attr("href", img_src);
        var main_img_img = main_img.find("img");
        main_img_img.animate({"opacity": 0}, 150, function() {
            main_img_img.removeAttr("src").attr("src", img_src);
            main_img_img.attr("srcset", src_set);
            main_img_img.animate({"opacity": 1}, 150);
        });

        return false;
    });

    jQuery("a.woocommerce-main-image").prettyPhoto({
        hook: 'data-rel',
        social_tools: false,
        theme: 'pp_woocommerce',
        horizontal_padding: 20,
        opacity: 0.8,
        deeplinking: false
    });
});