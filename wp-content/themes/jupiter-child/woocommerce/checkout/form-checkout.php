<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}


  if($_POST['is_epoint']==1)
  {
	  
	  applyEpointCustom($_POST['epoint_code']);
	  
  }


?>
	<form action="" method="post" class="apply-epoint">
		  <input type="text" name="epoint_code" />
		  <input type="submit" value="Apply E-point" class="button"/>
          <input type="hidden" name="is_epoint" value="1"/>
		
		</form>
<form name="checkout" novalidate autocomplete="on" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		
	
		<div class="col2-set custom_checkout_field" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
			
			<?php woocommerce_checkout_payment();?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
     <div class="colser-right">
	<!--<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>-->

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order"> 
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
	
		<div class="form-row place-order" style="text-align:right;">
		<?php wc_get_template( 'checkout/terms.php' ); ?>
		 <a href="#" class="button alt">Cancel Order</a>
		<noscript>
			<?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
			<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" />
		</noscript>

		

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr('confirmation payment', 'woocommerce') . '" data-value="' . esc_attr('confirmation payment', 'woocommerce') . '" />' ); ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
	</div>

    </div>
	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

  <script src="../lib/jquery.payment.js"></script>

  <style type="text/css" media="screen">
    .has-error input {
      border-width: 2px;
    }
    .validation.text-danger:after {
      content: 'Validation failed';
    }
    .validation.text-success:after {
      content: 'Validation passed';
    }
  </style>

  <script>
   /* jQuery(function($) {
      $('[data-numeric]').payment('restrictNumeric');
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');
      $.fn.toggleInputError = function(erred) {
        this.parent('.form-group').toggleClass('has-error', erred);
        return this;
      };
      $('form').submit(function(e) {
        e.preventDefault();
        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);
        $('.validation').removeClass('text-danger text-success');
        $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
      });
    });*/
  </script>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
