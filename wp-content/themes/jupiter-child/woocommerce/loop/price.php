<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if($product->is_type('bundle')) {
	$pointsval = get_post_meta( $product->get_id(), '_wc_points_earned', true );
	$bundled_items = $product->get_bundled_items();
	foreach($bundled_items as $bundled_item)
    {
    	if(!$bundled_item->is_optional()) {
        	$pointsval += get_post_meta( $bundled_item->get_product_id(), '_wc_points_earned', true );
    	}
    }
} else {
	$pointsval = get_post_meta( $product->get_id(), '_wc_points_earned', true );
}
?>


<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price roderick"><?php echo $price_html; ?>  
	<?php if($pointsval){
		echo "  $pointsval"."pp";
	} ?>
	</span>
<?php endif; ?>
