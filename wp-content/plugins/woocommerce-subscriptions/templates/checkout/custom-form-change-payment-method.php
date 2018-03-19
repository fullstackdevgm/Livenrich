<?php
/**
 * Pay for order form displayed after a customer has clicked the "Change Payment method" button
 * next to a subscription on their My Account page.
 *
 * @author 		Prospress
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<form id="order_review" method="post">

	
	<div id="payment">
		<?php $pay_order_button_text = apply_filters( 'woocommerce_change_payment_button_text', _x( 'Change Payment Method', 'text on button on checkout page', 'woocommerce-subscriptions' ) );

		if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) { ?>
		<ul class="payment_methods methods">
			<?php
                       // echo "dfgdgdg";
			if ( sizeof( $available_gateways ) ) {
                           
				current( $available_gateways )->set_current();
			}

			foreach ( $available_gateways as $gateway ) { ?>
				<li>
					<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( apply_filters( 'wcs_gateway_change_payment_button_text', $pay_order_button_text, $gateway ) ); ?>" />
					<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"><?php echo esc_html( $gateway->get_title() ); ?> <?php echo wp_kses_post( $gateway->get_icon() ); ?></label>
					<?php
					if ( $gateway->has_fields() || $gateway->get_description() ) {
                                            
						echo '<div class="payment_box payment_method_' . esc_attr( $gateway->id ) . '" style="display:none;">';
						$gateway->payment_fields();
						echo '</div>';
					}
					?>
				</li>
				<?php
			} ?>
		</ul>
				<?php } else { ?>
		<div class="woocommerce-error">
			<p> <?php esc_html_e( 'Sorry, it seems no payment gateways support changing the recurring payment method. Please contact us if you require assistance or to make alternate arrangements.', 'woocommerce-subscriptions' ); ?></p>
		</div>
				<?php } ?>

		<?php if ( $available_gateways ) : ?>
		<div class="form-row">
			<?php wp_nonce_field( 'wcs_change_payment_method', '_wcsnonce', true, true ); ?>
			<?php echo wp_kses( apply_filters( 'woocommerce_change_payment_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' ), array( 'input' => array( 'type' => array(), 'class' => array(), 'id' => array(), 'value' => array(), 'data-value' => array() ) ) ); ?>
			<input type="hidden" name="woocommerce_change_payment" value="<?php echo esc_attr( $subscription->get_id() ); ?>" />
		</div>
		<?php endif; ?>

	</div>

</form>
