<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="shop_table woocommerce-checkout-review-order-table3">
<ul class="product-list">
<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<li class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						
						   <div style="float:left;"> <?php echo $_product->get_image();?></div>
							<div style="margin-left:70px;">
							<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
					         <br/>
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							
							
							  <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                        ?>
						</div>
					
						
							
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</ul>	
	<?php	 $total_products=0;
$total_point=0;
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
$total_products=$total_products+$cart_item['quantity'];

$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
 $point=get_post_meta($product_id,'_wc_points_earned',true);
						
if($point=="" || $point==null)
 $point=round(get_post_meta($product_id,'_price',true));

 if($product_id==732)
{
	$point=$cart_item["custom_price_eshop"]/1.2;
}
						  

 $total_point=$total_point+($point*$cart_item['quantity']);
}?>	
	<ul class="checkout-summary">
	 <li class="cart-subtotal">
			<span class="left"><?php _e( 'Total Products', 'woocommerce' ); ?></span>
			<span class="right"><?php echo $total_products; ?></span>
		</li>
		 <li class="cart-subtotal">
			<span class="left"><?php _e( 'Total Points', 'woocommerce' ); ?></span>
			<span class="right"><?php echo $total_point; ?></span>
		</li>
	   <li class="cart-subtotal">
			<span class="left"><?php _e( 'Subtotal', 'woocommerce' ); ?></span>
			<span class="right"><?php wc_cart_totals_subtotal_html(); ?></span>
		</li>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<li class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<span class="left"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<span class="right"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</li>
		<?php endforeach; ?>

	

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<li class="fee">
				<span class="left"><?php echo esc_html( $fee->name ); ?></span>
				<span class="right"><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</li>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<li class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<span class="left"><?php echo esc_html( $tax->label ); ?></span>
						<span class="right"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="tax-total">
					<span class="left"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
					<span class="right"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<li class="order-total">
			<span class="left"><?php _e( 'Total', 'woocommerce' ); ?></span>
			<span class="right"><?php wc_cart_totals_order_total_html(); ?></span>
		</li>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	</ul>	
	<!--<table class="shop_table woocommerce-checkout-review-order-table3">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>

	<tbody>
	    <div>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-name">
						   <div style="float:left;"> <?php echo $_product->get_image();?></div>
							<div style="margin-left:70px;">
							<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?><br/>
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							
							
							  <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                        ?>
						</div>
						</td>
						<td class="product-total">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
		</div>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

	

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php _e( 'Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>-->
