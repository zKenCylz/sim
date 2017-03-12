<?php 
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
	return false;
}
global $woocommerce; ?>
<div id="header-minicart">
	<div class="header-minicart-icon">
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="Xem giỏ hàng"><span class="shopping-text">Giỏ hàng</span></a>
		<?php echo '<span class="minicart-number">'.$woocommerce->cart->cart_contents_count.'</span>'; ?> SP - <?php echo $woocommerce->cart->get_cart_total(); ?>
	</div>
	<div class="minicart-dropdown">
		<div class="minicart-padding">
			<p class="minicart-title">Sản phẩm trong giỏ hàng</p>
			<ul class="minicart-content">

				<?php foreach($woocommerce->cart->cart_contents as $cart_item_key => $cart_item): ?>

					<li>
						<a href="<?php echo get_permalink($cart_item['product_id']); ?>" class="product-image">
							<?php $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id']; ?>
							<?php echo get_the_post_thumbnail($thumbnail_id, array(70,60)); ?>
						</a>

						<?php
						global $product, $post, $wpdb, $average;
						$count = $wpdb->get_var($wpdb->prepare("
							SELECT COUNT(meta_value) FROM $wpdb->commentmeta
							LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
							WHERE meta_key = 'rating'
							AND comment_post_ID = %d
							AND comment_approved = '1'
							AND meta_value > 0
						",$cart_item['product_id']));

						$rating = $wpdb->get_var($wpdb->prepare("
							SELECT SUM(meta_value) FROM $wpdb->commentmeta
							LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
							WHERE meta_key = 'rating'
							AND comment_post_ID = %d
							AND comment_approved = '1'
						",$cart_item['product_id']));
						?>

						<div class="detail-item">
							<div class="product-details">
								<a href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo esc_html( $cart_item['data']->post->post_title ); ?></a>
								<div class="product-price">
									 <span class="price"><?php echo $woocommerce->cart->get_product_subtotal($cart_item['data'], 1); ?></span>
								</div>
								<div class="qty">
									<span class="qty-label">Số lượng:</span>
									<?php echo '<span class="qty-number">'.esc_html( $cart_item['quantity'] ).'</span>'; ?>
								</div>
								<div class="product-action">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="btn-remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), 'Xóa khỏi giỏ hàng' ), $cart_item_key ); ?>
								</div>
							</div>
						</div>

					</li>

				<?php endforeach; ?>

			</ul>
			<div class="cart-checkout">
			    <div class="price-total">
				   <span class="label-price-total">Tổng cộng:</span>
				   <span class="price-total-w"><span class="price"><?php echo $woocommerce->cart->get_cart_total(); ?></span></span>
				   
				</div>
				<div class="cart-links">
					<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" title="Giỏ hàng">Giỏ hàng</a></div>
					<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" title="Thanh toán">Thanh toán</a></div>
				</div>
			</div>
		</div>
	</div>
</div>