<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();


if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}


if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
?>


<section class="woocommerce-order-details">
	<!--<h2 class="woocommerce-order-details__title"><?php _e( 'Order details', 'woocommerce' ); ?></h2>-->

	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

		<thead>
			<tr>
				<th class="product-thumbnail"><?php _e( '商品', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php _e( '數量', 'woocommerce' ); ?></th>
			
				<th class="product-price"><?php _e( '單位積分', 'woocommerce' ); ?></th>
				<th class="product-point"><?php _e( '積分小計', 'woocommerce' ); ?></th>
				<th class="product-subtotal-point"><?php _e( '單位價格', 'woocommerce' ); ?></th>
				
				<th class="product-subtotal"><?php _e( '價格小計', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
			  $total_point=0;
			  $total_products=0;
				foreach ( $order_items as $item_id => $item ) {
					$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
                      $product_id = apply_filters( 'woocommerce_order_item_product_id', $item['product_id'], $item, $item_key );
					  
					  $total_products=$total_products+$item->get_quantity();
					  $point=get_post_meta($product_id,'_wc_points_earned',true);
		
		              if($point=="" || $point==null)
			             $point=$product->get_price();
					 
					  if($product_id==732){
					            $point=$item->get_total()/1.2; 
					  }
					 $t_point=$point*$item->get_quantity();
					 $total_point= $total_point+$t_point;
					 
					 
					 
					 
					wc_get_template( 'order/order-details-item.php', array(
						'order'			     => $order,
						'item_id'		     => $item_id,
						'item'			     => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'	     => $product ? $product->get_purchase_note() : '',
						'product'	         => $product,
					) );
				}
			?>
			<?php do_action( 'woocommerce_order_items_table', $order ); ?>
		</tbody>
</table>
<table class="summary">
		<tfoot>
		
		    <tr>
			  <th>Total products</th>
			  <td><?php echo $total_products;?></td>
			</tr>
			<tr>
			  <th>Total Points</th>
			<td><?php echo $total_point;?></td>
			</tr>
			<?php
				foreach ( $order->get_order_item_totals() as $key => $total ) {
					?>
					<tr>
						<th scope="row"><?php echo $total['label']; ?></th>
						<td><?php echo $total['value']; ?></td>
					</tr>
					<?php
				}
			?>
			<?php if ( $order->get_customer_note() ) : ?>
				<tr>
					<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
					<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
				</tr>
			<?php endif; ?>
		</tfoot>
	</table>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>

