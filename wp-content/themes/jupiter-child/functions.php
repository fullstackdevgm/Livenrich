<?php 

// Load translation files from your child theme instead of the parent theme
// function my_child_theme_locale() {
//     load_child_theme_textdomain( 'Jupiter', get_stylesheet_directory() . '/languages' );
// }
// add_action( 'after_setup_theme', 'my_child_theme_locale' );

function jupiter_child_child_theme_enqueue_scripts() {
  $parent_style = 'adorn_edge_default_style';
  
  wp_enqueue_style('jupiter_child_payment_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
  wp_register_script( 'jupiter_child_payment_script', get_stylesheet_directory_uri() . '/js/jquery.payment.js', array() , false, true );


  wp_enqueue_style('jupiter_child_payment_style');
  wp_enqueue_script( 'jupiter_child_payment_script' );

}
add_action( 'wp_enqueue_scripts', 'jupiter_child_child_theme_enqueue_scripts' );

//* Change “Proceed to Checkout” , “Add to cart” & “View Cart” button text for WooCommerce?*//
//Proceed to Checkout//
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 ); 
add_action('woocommerce_proceed_to_checkout', 'sm_woo_custom_checkout_button_text',20);

function sm_woo_custom_checkout_button_text() {
  $checkout_url = WC()->cart->get_checkout_url();
  ?>
  <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php  _e( '進行付款', 'woocommerce' ); ?></a> 
  <?php
} 

/*Add to cart*/
add_filter( 'woocommerce_product_single_add_to_cart_text', 'sm_woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'sm_woo_custom_cart_button_text' );   

function sm_woo_custom_cart_button_text() {
  return __( '加入購物車', 'woocommerce' );
}

/*View Cart
function sm_text_view_cart_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'View Cart' :
            $translated_text = __( '檢視購物車', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'sm_text_view_cart_strings', 20, 3 ); */

add_filter( 'woocommerce_billing_fields', 'wc_npr_filter_phone', 10, 1 );
function wc_npr_filter_phone( $address_fields ) {
  $address_fields['billing_phone']['required'] = false;
  $address_fields['billing_address_1']['required'] = false;
  $address_fields['billing_address_2']['required'] = false;
  $address_fields['billing_first_name']['required'] = false;
  $address_fields['billing_last_name']['required'] = false;
  $address_fields['billing_postcode']['required'] = false;
  $address_fields['billing_city']['required'] = false;
  return $address_fields;
}
add_filter( 'woocommerce_shipping_fields', 'wc_npr_filter_shipping_field', 10, 1 );
function wc_npr_filter_shipping_field( $address_fields ) {
  $address_fields['shipping_address_1']['required'] = false;
  $address_fields['shipping_address_2']['required'] = false;
  $address_fields['shipping_first_name']['required'] = false;
  $address_fields['shipping_last_name']['required'] = false;
  $address_fields['shipping_postcode']['required'] = false;
  $address_fields['shipping_city']['required'] = false;
  return $address_fields;
}

/* Remove the Order Comments on Checkout page */

add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
function alter_woocommerce_checkout_fields( $fields ) {
 unset($fields['order']['order_comments']);
 return $fields;
}

/* Remove the Some Field on Billing Address and Shipping Address Form */

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );


function custom_override_checkout_fields( $fields ) {
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_state']);
  unset($fields['shipping']['shipping_country']);
  unset($fields['billing']['billing_company']);
  unset($fields['shipping']['shipping_company']);
  unset($fields['shipping']['shipping_first_name']);
  unset($fields['shipping']['shipping_last_name']);
  unset($fields['shipping']['shipping_state']);
  

  return $fields;
}

function custom_override_billing_fields( $fields ) {
  unset($fields['billing_country']);
  return $fields;
}

function custom_override_shipping_fields( $fields ) {
  unset($fields['shipping_country']);
  return $fields;
}

// WooCommerce Checkout Fields Hook
//add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
// add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_payment', 20 );

/* add the Home Phone Field to Billing Address form*/
add_filter('woocommerce_checkout_fields', 'custom_override_billing_checkout_fields');
function custom_override_billing_checkout_fields($fields) {
  $fields['billing']['billing_homephone'] = array(
    'label' => __('', 'woocommerce'),
    'clear' => false,
    'type' => 'tel',
    'placeholder' => _x('Home Phone', 'placeholder', 'woocommerce'),
    'required' => true,
    'class' => array('home_phone') 
  );

  return $fields;
}
/* Add the Custom State field on Biiling Address Form*/
add_filter('woocommerce_checkout_fields', 'custom_override_billing_checkout_state_fields');
function custom_override_billing_checkout_state_fields($fields) {
  $fields['billing']['billing_state'] = array(
    'label' => __('', 'woocommerce'),
    'clear' => false,
    'type' => 'text',
    'placeholder' => _x('State', 'placeholder', 'woocommerce'),
    'required' => true,
    'class' => array('form-row-wide address-field'),

  );

  return $fields;
}
/* Add the Custom State field on Shipping Address Form*/
add_filter('woocommerce_checkout_fields', 'custom_override_shipping_checkout_state_fields');
function custom_override_shipping_checkout_state_fields($fields) {
  $fields['shipping']['shipping_state'] = array(
    'label' => __('', 'woocommerce'),
    'clear' => false,
    'type' => 'text',
    'placeholder' => _x('State', 'placeholder', 'woocommerce'),
    'required' => true,
    'class' => array('form-row-wide address-field')
  );

  return $fields;
}


/*  Custom Order all Field on Billing Address */
add_filter("woocommerce_checkout_fields", "custom_order_fields");

function custom_order_fields($fields) {
  $order = array(
    "billing_address_1",
    "billing_address_2",
    "billing_city",
    "billing_state",
    "billing_postcode",
    "billing_email", 
    "billing_phone",
    "billing_homephone"
  );

  foreach($order as $field)
  {
    $ordered_fields[$field] = $fields["billing"][$field];
  }

  $fields["billing"] = $ordered_fields;
  /* Add the Placeholder */
  $fields['billing']['billing_address_1']['placeholder'] = 'Address line 1';
  $fields['billing']['billing_address_2']['placeholder'] = 'Address line 2';
  $fields['billing']['billing_city']['placeholder'] = 'City';
  $fields['billing']['billing_postcode']['placeholder'] = 'Zip Code';
  $fields['billing']['billing_email']['placeholder'] = 'E-mail';
  $fields['billing']['billing_phone']['placeholder'] = 'Cell Phone';
  $fields['shipping']['shipping_address_1']['placeholder'] = 'Address line 1';
  $fields['shipping']['shipping_address_2']['placeholder'] = 'Address line 2';
  $fields['shipping']['shipping_city']['placeholder'] = 'City';
  $fields['shipping']['shipping_postcode']['placeholder'] = 'Zip Code';

  return $fields;
}

/* Remove the all label on checkout page */
add_filter('woocommerce_checkout_fields','custom_wc_checkout_fields_no_label');
function custom_wc_checkout_fields_no_label($fields) {
  foreach ($fields as $category => $value) {
    foreach ($fields[$category] as $field => $property) {
     unset($fields[$category][$field]['label']);
   }
 }
 return $fields;
}

/*  Custom Order all Field on shipping Address */
add_filter("woocommerce_checkout_fields", "order_shipping_fields");

function order_shipping_fields($fields) { 

  $order = array(
    "shipping_address_1",
    "shipping_address_2",
    "shipping_city",
    "shipping_state",
    "shipping_postcode",
  );
  foreach ($order as $field) {
    $ordered_fields[$field] = $fields["shipping"][$field];
  }

  $fields["shipping"] = $ordered_fields;
  unset($fields['order']['order_comments']);
  return $fields;
}
/* remove the company name and country on My account page */
function storefront_child_remove_unwanted_form_fields($fields) {
  unset( $fields ['company'] );
  unset( $fields ['country'] );
  return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'storefront_child_remove_unwanted_form_fields' );

/* how to display the fields in My Account and in the Admin-Order and Admin-User area. */
add_filter( 'woocommerce_billing_fields' , 'my_additional_billing_fields' );
function my_additional_billing_fields( $fields ) {
  $fields['billing_homephone'] = array(
    'label'         => __( 'Home Phone', 'woocommerce' ),
    'required'      => true,
    'class'         => array( 'form-row-last' ),
    'clear'         => true,
    'validate'      => array( 'phone' ),
  );
  return $fields;
}
add_filter( 'woocommerce_admin_billing_fields' , 'my_additional_admin_billing_fields' );
function my_additional_admin_billing_fields( $fields ) {
 $fields['phone'] = array(
  'label' => __( 'Home Phone', 'woocommerce' ),
);
 return $fields;
}
add_filter( 'woocommerce_customer_meta_fields' , 'my_additional_customer_meta_fields' );
function my_additional_customer_meta_fields( $fields ) {
  $fields['billing']['fields']['billing_homephone'] = array(
    'label' => __( 'Home Phone', 'woocommerce' ),
    'description' => '',
  );
  return $fields;
}
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
//add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'woocommerce_checkout_fields' , 'remove_ckt_phone_validation', 99 );function remove_ckt_phone_validation( $fields ) {    unset($fields['billing']['billing_phone']['validate']);   	return $fields;}


/* For Quantity Dropdown with Add to Cart  */
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<div class="quanity-box"><form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
		$html .= '<div class="quan-box">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '</div>';
		$html .= '<div class="button-cart"><span class="divider">|</span><button type="submit" class="button mk-moon-cart-plus alt"><svg class="mk-svg-icon" data-name="mk-moon-cart-2" data-cacheid="icon-5a2835fbeb8f2" style=" height:16px; width: 16px;    fill: #444; " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M423.609 288c17.6 0 35.956-13.846 40.791-30.769l46.418-162.463c4.835-16.922-5.609-30.768-23.209-30.768h-327.609c0-35.346-28.654-64-64-64h-96v64h96v272c0 26.51 21.49 48 48 48h304c17.673 0 32-14.327 32-32s-14.327-32-32-32h-288v-32h263.609zm-263.609-160h289.403l-27.429 96h-261.974v-96zm32 344c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16zm288 0c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16z"></path></svg></button></div>';
		$html .= '</form></div>';
	}
	return $html;
}

/* For Quantity Dropdown with Add to Cart  */
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link_bundle', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link_bundle( $html, $product ) {
	if ( $product && ($product->is_type( 'bundle' )||$product->is_type( 'mix-and-match' )) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<div class="quanity-box"><form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
		$html .= '<div class="quan-box">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= ' </div>';
		$html .= '<div class="button-cart"><span class="divider">|</span><button type="submit" class="button mk-moon-cart-plus alt"><svg class="mk-svg-icon" data-name="mk-moon-cart-2" data-cacheid="icon-5a2835fbeb8f2" style=" height:16px; width: 16px;    fill: #444; " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M423.609 288c17.6 0 35.956-13.846 40.791-30.769l46.418-162.463c4.835-16.922-5.609-30.768-23.209-30.768h-327.609c0-35.346-28.654-64-64-64h-96v64h96v272c0 26.51 21.49 48 48 48h304c17.673 0 32-14.327 32-32s-14.327-32-32-32h-288v-32h263.609zm-263.609-160h289.403l-27.429 96h-261.974v-96zm32 344c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16zm288 0c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16z"></path></svg></button></div>';
		$html .= '</form></div>';
	}
	return $html;
}


/*
				woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */

        add_action( 'woocommerce_single_product_summary', 'open_price_cart_block_container', 9 );
        function open_price_cart_block_container(){
         echo "<div class='price_cart'>";	
       }
       add_action( 'woocommerce_single_product_summary', 'close_price_cart_block_container', 19 );
       function close_price_cart_block_container(){
         echo "</div>";	
       }


       remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

       add_action( 'woocommerce_single_product_summary', 'woocommerce_reward_points', 12 );

       function woocommerce_reward_points(){
         global $product;
         $id =$product->id;;
         $pointsval = get_post_meta( $id, '_wc_points_earned', true ); 
         if($pointsval){
          echo "<span class='detail-page-ppval'>  $pointsval"."pp</span>";
        }

      }

      remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
      add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',16);

      add_action('woocommerce_single_product_summary','open_wrapper_add_to_cart',15);
      add_action('woocommerce_single_product_summary','close_wrapper_add_to_cart',17);
      function open_wrapper_add_to_cart(){
       echo "<div class='add-cart-wrapper'>";
     }
     function close_wrapper_add_to_cart(){
       echo "</div>";
     }




/* smart coupon

//add_action( 'woocommerce_applied_coupon', 'mwd_get_applied_coupons' );

function mwd_get_applied_coupons() {
  
    foreach ( WC()->cart->get_coupons() as $code => $coupon ) {
        if($coupon->code == $_POST['coupon_code']) {
           $current_coupon=$coupon;
        }
    }    
	
	
     if($current_coupon->discount_type ==  'smart_coupon') {
		 $user_id=get_current_user_id(); 
		 $fund= get_user_meta( $user_id, 'account_funds', true );
		 $coupon_amount=$current_coupon->get_amount();
		 $new_fund=$fund+$coupon_amount;
		 update_user_meta( $user_id, 'account_funds', $new_fund );
	 }
	
	
	
   
}


function applyEpointCustom($code=null)
{
	if(!$code)
		return false;
	
	global $wpdb;
	$table=$wpdb->prefix."posts";
	
	$query="select * from $table where post_name='".$code."' and post_type='shop_coupon' and post_status='publish'";
	
	$results= $wpdb->get_results($query);
	
	if(count($results)>0)
	{
		
		$post_id=$results[0]->ID;
		$coupon_value=get_post_meta($post_id,'coupon_amount',true);
		
		$user_id=get_current_user_id(); 
		 $fund= get_user_meta( $user_id, 'account_funds', true );
		
		 $new_fund=$fund+$coupon_value;
		 update_user_meta( $user_id, 'account_funds', $new_fund );
		 update_post_meta( $post_id, 'used_by', $user_id );
		
		 $my_post = array(
      'ID'           => $post_id,
      'post_status'   => 'used'
     
     );

       wp_update_post( $my_post ); 
		return true;
	}
	else return false;
	
	
}
*/

add_action( 'woocommerce_single_product_summary', 'getCustomTopupField', 99, 2 ); 

function getCustomTopupField()
{
	
	global $product;
  if($product->id==732){
   ?>
   <form method="post">
     <h3><label for="topup_amount">Enter Amount</label></h3>
     <p class="form-row form-row-first">
      <input class="input-text" name="topup_amount" id="topup_amount" step="1" value="5" min="5" max="10000" type="number">
    </p>
    <p class="form-row">
      <input name="wc_account_funds_topup" value="true" type="hidden">
      <input class="button" value="Buy Now" type="submit">
    </p>
    <input id="_wpnonce" name="_wpnonce" value="59eca89afa" type="hidden"><input name="_wp_http_referer" value="/liven/my-account/account-funds/" type="hidden"></form>
    <?php
  }
}



function my_custom_add_to_cart_redirect( $url ) {
	if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
		return $url;
	}
	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );










/* My Order shortcide */
function shortcode_my_orders( $atts ) {
  extract( shortcode_atts( array(
    'order_count' => -1
  ), $atts ) );

  ob_start();
  wc_get_template( 'myaccount/my-orders.php', array(
    'current_user'  => get_user_by( 'id', get_current_user_id() ),
    'order_count'   => $order_count
  ) );
  return ob_get_clean();
}
add_shortcode('my_orders', 'shortcode_my_orders');



/* Epoint Purchase History shortcide */
function shortcode_user_epoint_purchase_history( $atts ) {
  extract( shortcode_atts( array(
    'order_count' => -1
  ), $atts ) );

  ob_start();
  wc_get_template( 'myaccount/my-orders-epoint.php', array(
    'current_user'  => get_user_by( 'id', get_current_user_id() ),
    'order_count'   => $order_count
  ) );
  return ob_get_clean();
}
add_shortcode('epoint_purchase_history', 'shortcode_user_epoint_purchase_history');


/* My Sybscription */
function shortcode_user_my_subscriptions(  ) {




  ob_start();
  $subscriptions = wcs_get_users_subscriptions();
  $user_id       = get_current_user_id();

   //wc_get_template( 'myaccount/my-subscriptions.php', array( 'subscriptions' => $subscriptions, 'user_id' => $user_id ), '', plugin_dir_path( WC_Subscriptions::$plugin_file ) . 'templates/' );

  wc_get_template( 'myaccount/my-subscriptions.php', array( 'subscriptions' => $subscriptions, 'user_id' => $user_id ) );


  return ob_get_clean();
}

add_shortcode('user_my_subscriptions', 'shortcode_user_my_subscriptions');

/* My Sybscription */
function shortcode_user_view_subscriptions(  ) {
  ob_start();

  wc_get_template( 'myaccount/uap-view-subscription.php', array() );

  return ob_get_clean();
}

add_shortcode('user_view_subscriptions', 'shortcode_user_view_subscriptions');



/* My Payment methd */
function shortcode_user_payment_method(  ) {
 do_action( 'before_woocommerce_add_payment_method' );



 wc_get_template( 'myaccount/uap-form-add-payment-method.php' );
                        //
                       // wc_get_template( 'checkout/form-pay.php' );
                        //
                      // wc_print_notices();
			//do_action( 'after_woocommerce_add_payment_method' );
}

add_shortcode('user_payment_method', 'shortcode_user_payment_method');



function getBundleProducts($bundle_id)
{

	$products = array();
	global $wpdb;
	$table=$wpdb->prefix."woocommerce_bundled_items";
	$query="select * from $table where bundle_id=$bundle_id";
	$results= $wpdb->get_results($query);
	
	if(count($results)>0)
	{
		foreach($results as $result)
      $products[]=$result->product_id;
  }

  return $products;
}
function getMixProducts($product_id)
{

	$products=array();
	//$products[]=$product_id;
	$products_add=get_post_meta($product_id,'_mnm_data')[0];
	
	if(count($products_add)>0)
	{
		foreach($products_add as $pro=>$result)
      $products[]=$pro;
  }

  return $products;
}



/* get site url*/
function shortcode_user_get_site_url() {

  echo get_site_url();
}
add_shortcode('user_get_site_url', 'shortcode_user_get_site_url');



function user_email_from($user_id)
{
 global $wpdb;

 $user_email = $wpdb->get_var( "SELECT user_email FROM wp_users where ID=$user_id" );
 echo $user_email;
       //echo "SELECT user_email FROM $wpdb->wp_users where ID=$user_id";
}


/*add_filter( 'woocommerce_billing_fields', 'wc_optional_billing_fields', 10, 1 );
function wc_optional_billing_fields( $address_fields ) {
    $address_fields['billing_first_name']['required'] = false;
    $address_fields['billing_last_name']['required'] = false;
     $address_fields['billing_phone']['required'] = false;
      $address_fields['billing_email']['required'] = false;
       $address_fields['billing_homephone']['required'] = false;
    return $address_fields;
  }*/


/*add_filter( 'woocommerce_shipping_fields', 'wc_optional_shipping_fields', 10, 1 );
function wc_optional_shipping_fields( $address_fields ) {
    $address_fields['shipping_first_name']['required'] = false;
    $address_fields['shipping_last_name']['required'] = false;
     $address_fields['shipping_phone']['required'] = false;
      $address_fields['shipping_email']['required'] = false;
       $address_fields['shipping_homephone']['required'] = false;
        $address_fields['shipping_state']['required'] = false;
    return $address_fields;
  }*/





  function action_woocommerce_customer_save_address( $user_id, $load_address ) { 
       //wp_safe_redirect(wc_get_page_permalink('myaccount')); 
    wp_safe_redirect($_SERVER['HTTP_REFERER']);
   // print_r($_SERVER);
    exit;
  }; 
  add_action( 'woocommerce_customer_save_address', 'action_woocommerce_customer_save_address', 99, 2 ); 




  function so_validate_add_cart_item( $passed, $product_id, $quantity, $variation_id = '', $variations= '' ) {

    // do your validation, if not met switch $passed to false
    if ($product_id==941){

		//var_dump($_POST['mnm_quantity']);exit;
      $total_point=0;
      foreach($_POST['mnm_quantity'] as $pid=>$qty)
      {

        $total_point=$total_point+$qty*$_POST['product_pp'][$pid];



      }
      if($total_point<500)
      {
        $passed = false;
        wc_add_notice( __( 'PP must be more than or equal 500', 'woocommerce' ), 'error' );
      }

      if( isset( $_POST['custom_price'] ) && !empty($_POST['custom_price'])) {	    
       update_post_meta(941,'custom_mix_price_add',$_POST['custom_price']);


     }

   }
   return $passed;

 }
 add_filter( 'woocommerce_add_to_cart_validation', 'so_validate_add_cart_item', 10, 5 );

/*

function ipe_product_custom_price( $cart_item_data, $product_id ) {

	  if($_POST['add-to-cart']==941)
	  {
        if( isset( $_POST['custom_price'] ) && !empty($_POST['custom_price'])) {	    
           update_post_meta(941,'custom_mix_price_add',$_POST['custom_price']);
          
 
        }
	  }
       
        
    }
    
    add_filter( 'woocommerce_add_cart_item_data', 'ipe_product_custom_price', 99, 2 );


*/
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );

    function add_custom_price( $cart_object ) {

      $custom_price =get_post_meta(941,'custom_mix_price_add',true);
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if($cart_item['product_id']==941)
        {
          $cart_item['data']->set_price($custom_price);  
        }else if( isset( $cart_item["custom_price_eshop"] ) ) {
                    //$value['data']->price = $value["custom_price_eshop"];
          $cart_item['data']->set_price($cart_item["custom_price_eshop"]); 
        }			

      }
    }







    function ipe_product_custom_price( $cart_item_data, $product_id ) {
      if( isset( $_POST['custom_price_eshop'] ) && !empty($_POST['custom_price_eshop'])) {	    

        $cart_item_data[ "custom_price_eshop" ] = $_POST['custom_price_eshop'];    
      }
      return $cart_item_data;

    }
    
    add_filter( 'woocommerce_add_cart_item_data', 'ipe_product_custom_price', 99, 2 );


   /*function ipe_apply_custom_price_to_cart_item( $cart_object ) {  
        if( !WC()->session->__isset( "reload_checkout" )) {
            
            foreach ( $cart_object->cart_contents as $key => $value ) {
                if( isset( $value["custom_price_eshop"] ) ) {
                    //$value['data']->price = $value["custom_price_eshop"];
					 $value['data']->set_price($value["custom_price_eshop"]); 
                }
            }  
        }  
    }
    
    add_action( 'woocommerce_before_calculate_totals', 'ipe_apply_custom_price_to_cart_item', 99 );*/















    function getReferrerAmount($product_price,$affiliate_id,$user_id)
    {
     global $wpdb;
     $table=$wpdb->prefix."uap_affiliates";
     $query="select * from $table where id=$affiliate_id";
     $result= $wpdb->get_row($query);
     $affiliate_rankid=$result->rank_id;

     $query="select * from $table where uid=$user_id";
     $result= $wpdb->get_row($query);
     $user_rankid=$result->rank_id;

     $affiliate_amount=getRankValue($affiliate_rankid);
	 
	
    // $user_amount=getRankValue($user_rankid);

     //$amount=$user_amount-$affiliate_amount;
	 
	 $amount= $affiliate_amount;
     if($user_rankid==2)
		$amount= $affiliate_amount-20;
	if($user_rankid==3 || $user_rankid==4)
		$amount= $affiliate_amount-40;
	
	 
	 
	 
     $cal=$product_price*$amount/100;
     return $cal; 

   }

   function getRankValue($rank_id)
   {

     global $wpdb;
     $table=$wpdb->prefix."uap_ranks";
     $query="select * from $table where id=$rank_id";
     $result= $wpdb->get_row($query);
     return $result->amount_value;
   }






   /*function prefix_add_discount_line( $cart ) {
    $user_id       = get_current_user_id();	

    $account_funds=get_user_meta($user_id,'account_funds',true);	
    $points=getCartTotalPoint();

    if($points>$account_funds)
     return false;





   if($_POST['ep']==1)
   {

     global $woocommerce;  
     $cart_total=$woocommerce->cart->subtotal;
	//$cart_total=$cart->get_total_ex_tax();


     $discount = $cart_total;

     $cart->add_fee( __( 'E Point', 'yourtext-domain' ) , -$discount );
   }

 }
 add_action( 'woocommerce_cart_calculate_fees', 'prefix_add_discount_line' );*/

 
 
 
 
 
 
 

 function getCartTotalPoint()
 {



  $total_point=0;
  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {


    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
    $point=get_post_meta($product_id,'_wc_points_earned',true);

    if($point=="" || $point==null)
     $point=round(get_post_meta($product_id,'_price',true));

   $total_point=$total_point+($point*$cart_item['quantity']);
 }


 return $total_point;
}

function getCurrentUserAccountFund() {
  $user_id       = get_current_user_id();	

  $account_funds=get_user_meta($user_id,'account_funds',true);	
  return $account_funds;

}

add_filter( 'woocommerce_quantity_input_min', 'wwp_woocommerce_quantity_input_min' );
add_filter( 'woocommerce_quantity_input_max', 'wwp_woocommerce_quantity_input_max' );

function wwp_woocommerce_quantity_input_min() {
  return 0;
}
function wwp_woocommerce_quantity_input_max() {
  return 99;
}

add_filter( 'woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 15, 2 );

function jk_woocommerce_quantity_input_args( $args, $product ) {
  if( in_array(32, $product->category_ids) ) {
    $args['max_value']  = 99;   // Maximum value    // Minimum value
    $args['step']  = 1;
    if( is_product() ) {
      $args['input_value']  = 0;
      $args['min_value']  = 0;
    } else {
      $args['min_value']  = 1;
    }
  } else {
    if( is_product() ) {
      $args['input_value']  = 1;
    }
    $args['max_value']  = 99;
    $args['min_value']  = 1;
    $args['step']  = 1;
  }
  return $args;
}



add_action( 'woocommerce_payment_complete', 'addAccountFundCustom', 10 );

function addAccountFundCustom($order_id)
{
	
  if ( ! $order_id )
    return;

  $order = new WC_Order( $order_id );
  $items = $order->get_items();

   //Loop through them, you can get all the relevant data:

  foreach ( $items as $item ) {

    $product_id = $item['product_id'];

    if($product_id==732)
    {
     $user_id=get_current_user_id(); 
     $fund= get_user_meta( $user_id, 'account_funds', true );
     $point=$item->get_total()/1.2; 
     $new_fund=$fund+$point;
     update_user_meta( $user_id, 'account_funds', $new_fund );

   }

 }

}


add_action( 'gform_after_submission_13', 'sendShareEmais', 10, 2 );
function set_post_content( $entry, $form ) {
//	$email => rgar( $entry, '1.3' );
    $current_user = wp_get_current_user();
	$username=$current_user->user_login;
	$home_url='http://envisionmt.org/liven/?ref='.$username;
	$dataArray = GFFormsModel::unserialize($entry[1]);
	if(count($dataArray)>0)
		foreach($dataArray as $value)
		{
			$email=$value[2][0];
			$page=$value[3][0];
			$url=$value[4][0];
			$mes=$value[5][0];
			saveCustomInvites($email,$page,$url,$mes);
			
			
			$to = $email;
			$subject = "Affiliate Invitation";
			//$message = "<p>Page Link: ".$page."<br/> Url: ".$url."</p><p>".$mes."</p>";
			$message = file_get_contents(get_stylesheet_directory().'/email-template.php'); 
			$message=str_ireplace('{Message}',$mes,$message);
			$message=str_ireplace('{Url}',$url,$message);
			$message=str_ireplace('{Name}',$current_user->display_name,$message);
			$message=str_ireplace('{Referral Link}',$home_url,$message);
			$from = 'min@envisionmt.org';
			$headers = "From:" . $from. "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html\r\n";
      mail($to,$subject,$message,$headers);
      

    }


  }
  
  
  
  function sendShareEmais( $entry, $form ) {
//	$email => rgar( $entry, '1.3' );
  
	if($entry["2"]!="" && $entry["4"]!="")
      sentInvites($entry["2"],$entry["3"],$entry["4"],$entry["5"]);
  
   if($entry["13"]!="" && $entry["11"]!="")
      sentInvites($entry["13"],$entry["12"],$entry["11"],$entry["10"]);
  
  
  if($entry["18"]!="" && $entry["16"]!="")
      sentInvites($entry["18"],$entry["17"],$entry["16"],$entry["15"]);
  
  if($entry["23"]!="" && $entry["21"]!="")
      sentInvites($entry["23"],$entry["22"],$entry["21"],$entry["20"]);
  
  if($entry["28"]!="" && $entry["26"]!="")
      sentInvites($entry["28"],$entry["27"],$entry["26"],$entry["25"]);

  }
  
  
  function sentInvites($email,$page=null,$url=null,$mes=null)
  {
	    $current_user = wp_get_current_user();
	$username=$current_user->user_login;
	$home_url='http://envisionmt.org/liven/?ref='.$username;
	
             saveCustomInvites($email,$page,$url,$mes);
			
			
			$to = $email;
			$subject = "Affiliate Invitation";
			//$message = "<p>Page Link: ".$page."<br/> Url: ".$url."</p><p>".$mes."</p>";
			$message = file_get_contents(get_stylesheet_directory().'/email-template.php'); 
			$message=str_ireplace('{Message}',$mes,$message);
			$message=str_ireplace('{Url}',$url,$message);
			$message=str_ireplace('{Name}',$current_user->display_name,$message);
			$message=str_ireplace('{Referral Link}',$home_url,$message);
			$from = 'min@envisionmt.org';
			$headers = "From:" . $from. "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html\r\n";
          mail($to,$subject,$message,$headers);
  
  }
  
  
  
  

  function jupiter_child_bundle_page_enqueue_scripts() {

    wp_register_script( 'bundle_page_script', get_stylesheet_directory_uri() . '/js/bundle-page.js', array() , false, true );
    wp_register_script( 'avatar_dialog_script', get_stylesheet_directory_uri() . '/js/avatar-upload.js', array() , false, true );
    wp_localize_script( 'bundle_page_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'cart_url' => wc_get_cart_url(), 'checkout_url' => wc_get_checkout_url, 'update_cart_option_nonce' => wp_create_nonce( 'wcsatt_update_cart_option' ), 'wc_ajax_url'              => WC_AJAX::get_endpoint( "%%endpoint%%" )));
    wp_localize_script( 'avatar_dialog_script', 'avatar', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'cart_url' => wc_get_cart_url(), 'checkout_url' => wc_get_checkout_url));

    if ( is_page( 'cart' ) || is_cart() ) {
      wp_register_script( 'cart_update_script', get_stylesheet_directory_uri() . '/js/cart-update.js');
      wp_enqueue_script( 'cart_update_script' );
    }

    wp_enqueue_script( 'bundle_page_script' );
    wp_enqueue_script( 'avatar_dialog_script' );

  }
  add_action( 'wp_enqueue_scripts', 'jupiter_child_bundle_page_enqueue_scripts' );


  add_action( 'wp_ajax_group_product', 'group_product_callback' );
  add_action( 'wp_ajax_nopriv_group_product', 'group_product_callback' );

  function group_product_callback() {
    if(!empty($_POST['product_id'])) {
      $max_value = 99;

      $bundle_product = get_product($_POST['product_id']);
      $bundled_items = $bundle_product->get_bundled_items();
      $child_products = array();
      $bundle_products = array();
      $default_count = $_POST['product_count'];

      foreach ($bundled_items as $bundled_item) {
        if($bundled_item->is_optional()) {
          $child_products[] = $bundled_item->get_product_id();
        } else {
          $bundle_products[] = $bundled_item->get_product_id();
        }
      }

      $result = '<div class="bundle-list"><form action="" method="post" enctype="multipart/form-data">';
      $result .= sprintf("<h2>%s%s</h2>", $bundle_product->get_name(), __("Bundle内容"));
      $result .= sprintf('<p class="point-cal">*%s<span>500</span>%s <span class="pointsval">0</span>%s</p>', __('如果還沒達到'), __('積分，則不能成功創造bundle 目前積分'), __('積分'));
      $result .= '<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0"><thead><tr><th></th>';
      $result .= sprintf('<th>%s</th>', __( '商品', 'woocommerce' ));
      $result .= sprintf('<th>%s</th>', __( '數量', 'woocommerce' ));
      $result .= sprintf('<th class="product-quantity">%s</th>', __( '名称', 'woocommerce' ));
      $result .= sprintf('<th class="product-point">%s</th>', __( '積分小計', 'woocommerce' ));
      $result .= sprintf('<th class="product-subtotal-point">%s</th>', __( '單位積分', 'woocommerce' ));
      $result .= sprintf('<th class="product-price">%s</th>', __( '單位價格', 'woocommerce' ));
      $result .= sprintf('<th class="product-subtotal">%s</th>', __( '價格小計', 'woocommerce' ));
      $result .= '</tr></thead><tbody>';
      $total_point = get_post_meta( $bundle_product->get_id(), '_wc_points_earned', true )*$default_count;
      $total_price = ($bundle_product->get_price() - 5)*$default_count;
      $total_products = $default_count;

      if(count($bundle_products)>0)
      {
        foreach($bundle_products as $product_id)
        {
          $product_loop = get_product($product_id);

          //echo $product_loop;

          $result .= '<tr><td><span></span></td><td>';
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
          $result .= sprintf('<img src="%s" width="60"/>', $image[0]);
          $result .= '</td><td>';
          $result .= sprintf('<input id="bundleid-%s" type="hidden" name="bundleid[%s]" value="%s"/>', $product_id, $product_id, $product_id);
          $result .= sprintf('<input id="prevsel-%s" type="hidden" name="prev_sel[%s]" value="%s"/>', $product_id, $product_id, 1);
          $result .= sprintf('<input id="default-%s" type="hidden" name="default-[%s]" value="%s"/>', $product_id, $product_id, $default_count);
          $result .= sprintf('<select name="quantity" title="Qty" class="qty qty-%s">', $product_id);
          $i = 1;
          while ($i <= $max_value) {
            if($i == 1) {
              $result .= sprintf('<option value="%s" selected="selected">%s%s</option>', $i, $i, __("套", 'woocommerce'));
            } else {
              $result .= sprintf('<option value="%s">%s%s</option>', $i, $i, __("套", 'woocommerce'));
            }
            $i++;
          }
          $result .= '</select></td>';
          $total_products=$total_products+1*$default_count;
          $result .= sprintf('<td>%s</td>', $product_loop->get_name());
          $point=get_post_meta($product_id,'_wc_points_earned',true);

          if($point=="" || $point==null)
            $point=round(get_post_meta($product_id,'_price',true));

          $result .= sprintf('<td class="unit-point">%s</td>', $point);
          $total_point=$total_point+$point*$default_count;
          $result .= sprintf('<td class="sub-point">%s</td>', $point*1);
          $price= $product_loop->get_price();
          $result .= sprintf('<td class="unit-price">$%s</td>', $price);
          $total_price=$total_price+$price*$default_count;
          $result .= sprintf('<td class="sub-price">$%s</td>', $price*1);
          $result .= '</tr>';
        }
      }

      if(count($child_products)>0)
      {
        foreach($child_products as $product_id)
        {
          $product_loop = get_product($product_id);

          $result .= '<tr style="display: none"><td><button class="remove">×</button></td><td>';
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
          $result .= sprintf('<img src="%s" width="60"/>', $image[0]);
          $result .= '</td><td>';
          $result .= sprintf('<input id="bundleid-%s" type="hidden" name="bundleid[%s]" value="%s"/>', $product_id, $product_id, $product_id);
          $result .= sprintf('<input id="prevsel-%s" type="hidden" name="prev_sel[%s]" value="%s"/>', $product_id, $product_id, 0);
          $result .= sprintf('<input id="default-%s" type="hidden" name="default-[%s]" value="%s"/>', $product_id, $product_id, $default_count);
          $result .= sprintf('<select name="quantity" title="Qty" class="qty qty-%s">', $product_id);
          $i = 0;
          while ($i <= $max_value) {
            if($i == 0) {
              $result .= sprintf('<option value="%s" selected="selected">%s%s</option>', $i, $i, __("套", 'woocommerce'));
            } else {
              $result .= sprintf('<option value="%s">%s%s</option>', $i, $i, __("套", 'woocommerce'));
            }
            $i++;
          }
          $result .= '</select></td>';
          $result .= sprintf('<td>%s</td>', $product_loop->get_name());
          $point=get_post_meta($product_id,'_wc_points_earned',true);

          if($point=="" || $point==null)
            $point=round(get_post_meta($product_id,'_price',true));

          $result .= sprintf('<td class="unit-point">%s</td>', $point);
          $result .= sprintf('<td class="sub-point">%s</td>', $point*1);
          $price= $product_loop->get_price();
          $result .= sprintf('<td class="unit-price">$%s</td>', $price);
          $result .= sprintf('<td class="sub-price">$%s</td>', $price*1);
          $result .= '</tr>';
        }
      }

      $result .= '</tbody></table>';
      $result .= '<table class="summary"><tr>';
      $result .= sprintf('<th>%s</th>', __('商 品 數 量： ', 'woocommerce'));
      $result .= sprintf('<td class="total-products">%s</td>', $total_products);
      $result .= '</tr><tr>';
      $result .= sprintf('<th>%s</th>', __('總   積   分： ', 'woocommerce'));
      $result .= sprintf('<td class="total-point">%spp</td>', $total_point);
      $result .= '</tr><tr>';
      $result .= sprintf('<th style="white-space: nowrap">%s</th>', __('Bundle Discount： ', 'woocommerce'));
      $result .= sprintf('<td class="bundle-discount">-$%s</td>', 5);
      $result .= '</tr><tr>';
      $result .= sprintf('<th>%s</th>', __('總   價   格： ', 'woocommerce'));
      $result .= sprintf('<td class="total-price">$%s</td>', $total_price);
      $result .= '</tr><tr>';
      $result .= sprintf('<td colspan="2" class="wcsatt-options-td"></td></tr></table>'/*, WCS_ATT_Display::get_subscription_options_content($bundle_product)*/);

      $result .= '<div class="clear"></div><div class="bottom-buttons">';
      $result .= sprintf('<input id="bundle-%s" type="hidden" name="bundle[%s]" value="%s"/>', $bundle_product->get_id(), $bundle_product->get_id(), $bundle_product->get_id());
      $result .= sprintf('<input id="bundlecnt-%s" type="hidden" name="bundlecnt[%s]" value="%s"/>', $default_count, $default_count, $default_count);
      $result .= sprintf('<button class="button group-add-to-cart">%s</button>', __('加入購物車', 'woocommerce'));
      $result .= sprintf('<button class="button add-to-bundle">%s</button>', __('結算', 'woocommerce'));
      $result .= '</div></form></div>';

      if (($key = array_search($bundle_product->get_id(), $child_products)) !== false) {
        unset($child_products[$key]);
      }

      $result .= '<div class="mixmatch-list">';

      $result .= '<p class="point-cal">*更改Boundle内容 點擊加入Boundle</p>';

      $result .= '<form method="post" enctype="multipart/form-data" class="mnm_form cart cart_group"><ul>';
      if(count($child_products)>0)
      {
        foreach($child_products as $product_id)
        { 
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
          $pdt = get_product($product_id);
          $unit_price= $pdt->get_price();  
          $result .= '<li>';
          $result .= sprintf('<img src="%s" width="180"/>', $image[0]);
          $result .= sprintf('<h4 class="product-name">%s</h4>', $pdt->get_name());
          $result .= sprintf('<div class="price-point"><span class="price">%s</span><span class="point">', $pdt->get_price_html());

          $point=get_post_meta($product_id,'_wc_points_earned',true);

          if($point=="" || $point==null)
            $point=round(get_post_meta($product_id,'_price',true));

          $result .= sprintf('%spp', $point);
          $result .= sprintf('</span></div>');
          $result .= '<div class="quan-box"><div class="quantity_select">';
          $result .= sprintf('<input id="itemid-%s" type="hidden" name="itemid[%s]" value="%s"/>', $product_id, $product_id, $product_id);
          $result .= sprintf('<select name="mnm_quantity[%s]" title="Qty" class="qty extra-qty" id="proqty-%s">', $product_id, $product_id);
          $result .= sprintf('<option value="0" selected="selected">0%s</option>', __("套", 'woocommerce'));
          $i = 1;
          while ($i <= $max_value) {
            $result .= sprintf('<option value="%s">%s%s</option>', $i, $i, __("套", 'woocommerce'));
            $i++;
          }
          $result .= '</select>';
          $result .= '<div class="button-cart"><span class="divider">|</span><button type="submit" class="button mk-moon-cart-plus alt"><svg class="mk-svg-icon" data-name="mk-moon-cart-2" data-cacheid="icon-5a2835fbeb8f2" style=" height:16px; width: 16px;    fill: #444; " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M423.609 288c17.6 0 35.956-13.846 40.791-30.769l46.418-162.463c4.835-16.922-5.609-30.768-23.209-30.768h-327.609c0-35.346-28.654-64-64-64h-96v64h96v272c0 26.51 21.49 48 48 48h304c17.673 0 32-14.327 32-32s-14.327-32-32-32h-288v-32h263.609zm-263.609-160h289.403l-27.429 96h-261.974v-96zm32 344c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16zm288 0c0 22-18 40-40 40h-16c-22 0-40-18-40-40v-16c0-22 18-40 40-40h16c22 0 40 18 40 40v16z"></path></svg></button></div>';
          $result .= '</div></div>';
          $result .= sprintf('<input id="proprice-%s" type="hidden" name="product_price[%s]" value="%s"/>', $product_id, $product_id, $unit_price);
          $result .= sprintf('<input id="propoint-%s" type="hidden" name="product_pp[%s]" value="%s"/>', $product_id, $product_id, $point);
          $result .= '</li>';
        }
      }
      $result .= '</ul></form></div><div class="clear"></div>';

      echo $result;
      //echo sprintf("<div id='hidden-bundle'>%s</div>", do_shortcode('[product_page id="'.$_POST['product_id'].'"]'));
    }

    exit;
  }
  
  if ( (isset($_GET['action']) && $_GET['action'] != 'logout') || (isset($_POST['login_location']) && !empty($_POST['login_location'])) ) {
    add_filter('login_redirect', 'my_login_redirect', 10, 3);
    function my_login_redirect() {
      $location = $_SERVER['HTTP_REFERER'];
      wp_safe_redirect($location);
      exit();
    }
  }
  
  function get_name_for_refurl( $atts ) {
    $return = '';
    $username = $_COOKIE['referral_name'];
    if($username) {
      $user = get_user_by('login', $username);
      $return .= sprintf('<span class="full-name">%s %s</span>', $user->first_name, $user->last_name);
      unset($_COOKIE['referral_name']);
      setcookie('referral_name', '', time() - 3600, "/");
    } else {
      $return .= sprintf('<span class="full-name">%s %s</span>', "Norman", "Chen");
    }
    return $return;
  }
  add_shortcode( 'nameforurl', 'get_name_for_refurl' );

  add_action( 'init', 'my_setcookie_referral' );
  function my_setcookie_referral() {
    if($_GET['ref']) {
      setcookie( "referral_name", $_GET['ref'], time() + 1000, "/");
    }
  }

/*  function custom_discount() {
  
    // Get current total number of bundle products
    $qty = 0;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      $product = get_product($cart_item['product_id']);
      if($product->is_type('bundle')) {
        $qty += $cart_item['quantity'];
      }
    }
       
    $cu_discount = 5;    
      
    // Alter the cart discount total
    WC()->cart->set_discount_total($cu_discount * $qty);

    $discount = (double)get_post_meta($order_id,'_cart_discount',true);
    update_post_meta($order_id,'_cart_discount',$cu_discount * $qty + $discount);
    //file_put_contents("cart.log", "\nStart: ".$discount * $qty."\n", FILE_APPEND);
  }
  add_action('woocommerce_calculate_totals', 'custom_discount');*/

  function sale_custom_price($cart_object) {
  // Calculate discount amount and return $discount

    $cu_discount = -5;

    // Get current total number of bundle products
    $qty = 0;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      $product = get_product($cart_item['product_id']);
      if($product->is_type('bundle')) {
        $qty += $cart_item['quantity'];
      }
    }

    if($qty > 0)
      $cart_object->add_fee('Bundle Discount', $cu_discount * $qty, true, '');
  }

  add_action( 'woocommerce_cart_calculate_fees', 'sale_custom_price');

  
  
  
  
  
function prefix_add_discount_line( $cart ) {
    $user_id       = get_current_user_id();	

    $account_funds=get_user_meta($user_id,'account_funds',true);	
	$input_value=$_POST['e_amount'];
	
	 if($input_value>$account_funds)
     return false;
	
	

	if (!session_id()) {
		session_start();
	}

   if($_POST['terms']!="")
	 {
		  $epoint=$_SESSION['e_point'];
		  if($epoint>0)
			   $cart->add_fee( __( 'E Point', 'yourtext-domain' ) , -$epoint );
		   
		   $rpoint=$_SESSION['r_point'];
		  if($rpoint>0)
			   $cart->add_fee( __( 'Reward Point', 'yourtext-domain' ) , -$rpoint );
	 }

   if($_POST['ep']==1)
   {

     global $woocommerce;  
     $cart_total=$woocommerce->cart->subtotal;
	//$cart_total=$cart->get_total_ex_tax();
	
	   if($_POST['e_amount']!="")
	   {  $input_value=$_POST['e_amount'];
		   if($input_value>=$cart_total)
             $ediscount = $cart_total;
		   else
		     $ediscount=$input_value*1.2;
		   $cart->add_fee( __( 'E Point', 'yourtext-domain' ) , -$ediscount );
		   $_SESSION['e_point'] = $ediscount;
		   
		   
	   }
	 $cart_total=$woocommerce->cart->subtotal;
	  if($_POST['r_amount']!="")
	   {
		   $input_value=$_POST['r_amount'];
		   if($input_value>=$cart_total)
             $rdiscount = $cart_total;
		   else
		     $rdiscount=$input_value;
		   
		   $cart->add_fee( __( 'Reward Point', 'yourtext-domain' ) , -$rdiscount );
		   $_SESSION['r_point'] = $rdiscount;
		   
	   }
	
    

    
   }

 }
 add_action( 'woocommerce_cart_calculate_fees', 'prefix_add_discount_line' );
 
 

//add_action( 'woocommerce_payment_complete', 'applyAccountFund', 10 );
add_action( 'woocommerce_new_order', 'applyAccountFund', 10 );

function applyAccountFund($order_id)
{
	
  //var_dump($_SESSION);exit;
     $user_id=get_current_user_id(); 
	 
	 if(isset($_SESSION['e_point']) && $_SESSION['e_point']>0)
	 {
     $fund= get_user_meta( $user_id, 'account_funds', true );
     $point=$_SESSION['e_point']/1.2; 
     $new_fund=$fund-$point;
     update_user_meta( $user_id, 'account_funds', $new_fund );
	 }
	 
  if(isset($_SESSION['r_point']) && $_SESSION['r_point']>0)
	 {
       updateWalletBalanceReferral($user_id,$_SESSION['r_point'],'debit','Redeem Product');
	 }



}


function getRamdamID()
{
	
	
	for($i=1;$i<10;$i++)
	{
		$rand=rand(100000,1000000);
		if(!isExistUser($rand))
			break;
		
	}
	
	
		return $rand;
	 
	
}

function isExistUser($user_login)
{
	
	global $wpdb;
     $table=$wpdb->prefix."users";
     $query="select * from $table where user_login=$rand";
     $result= $wpdb->get_row($query);
     if($result)
		 return true;
	 else
		  return false;
	 
	
}

function currentUserShippingAddress($user_id=null)
{
	if(!$user_id)
     $user_id=get_current_user_id(); 
 
   $first_name=get_user_meta($user_id,'shipping_first_name',true);
   $last_name=get_user_meta($user_id,'shipping_last_name',true);
   $address1=get_user_meta($user_id,'shipping_address_1',true);
   $address2=get_user_meta($user_id,'shipping_address_2',true);
   $city=get_user_meta($user_id,'shipping_city',true);
   $state=get_user_meta($user_id,'shipping_state',true);
   $zip=get_user_meta($user_id,'shipping_postcode',true);
   $country=get_user_meta($user_id,'shipping_country',true);
   
   
   $shipping_address=$first_name.' '.$last_name.', '.$address1.' '.$address2;
   $shipping_address.=$city.' '.$state.', '.$zip.' '.$country;
   
  
 
 return $shipping_address;
	
	
	
}

?>