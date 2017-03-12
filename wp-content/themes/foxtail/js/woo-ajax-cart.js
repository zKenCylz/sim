/**
 * Created by nhansay on 7/29/2016.
 */
jQuery(document).ready(function () {

    jQuery( document ).on( 'click', '.add_to_cart_button', function() {
        var this_button = jQuery(this);
        this_button.append('<div class="spinner"></div>');
    });

    jQuery( 'body' ).on( 'added_to_cart', function ( event, fragments, cart_hash, $button ) {
        //$button.append('<div class="spinner"></div>');
        update_mini_cart($button);
    } );

    jQuery('body').on('wc_fragments_refreshed', function () {
        update_mini_cart();
    })
});

function update_mini_cart($button, old_text) {
    jQuery.post(
        foxtail_ajax_object.ajax_url,
        {
            action      : 'foxtail_ajax-submit',
            nonce       : foxtail_ajax_object.foxtail_product_nonce
        },
        function(response) {
            //console.log(response);
            jQuery("#header-cart").html(response.content);
            if ($button != undefined)
                $button.find(".spinner").remove();
        }
    );
}