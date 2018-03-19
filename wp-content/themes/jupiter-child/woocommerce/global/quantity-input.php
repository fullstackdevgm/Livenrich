<?php
/**
 * Product quantity inputs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.7
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
?>
<div class="quantity_select">
    <select name="<?php echo esc_attr( $input_name ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="qty">
    <?php
    for ( $count = $min_value; $count <= $max_value; $count = $count+$step ) {
        if ( $count == $input_value )
            $selected = ' selected';
        else $selected = '';
        echo '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
    }
    ?>
    </select>
</div>