<?php
/**
 * View Subscription
 *
 * Shows the details of a particular subscription on the account page
 *
 * @author    Prospress
 * @package   WooCommerce_Subscription/Templates
 * @version   2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wp;

//wc_maybe_define_constant( 'WOOCOMMERCE_CHECKOUT', true );
do_action( 'woocommerce_checkout_init', WC_Checkout::instance() );
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
 //  print_r($_POST);
    
    $post_id= $wp->query_vars['view-subscription'];
   
   update_post_meta($post_id,'_billing_address_1', $_POST['_billing_address_1'] );
   update_post_meta($post_id,'_billing_address_2', $_POST['_billing_address_2'] );
   update_post_meta($post_id,'_billing_city', $_POST['_billing_city'] );
   update_post_meta($post_id,'_billing_state', $_POST['_billing_state'] );
   update_post_meta($post_id,'_billing_postcode', $_POST['_billing_postcode'] );
   
   update_post_meta($post_id,'_shipping_address_1', $_POST['_shipping_address_1'] );
   update_post_meta($post_id,'_shipping_address_2', $_POST['_shipping_address_2'] );
   update_post_meta($post_id,'_shipping_city', $_POST['_shipping_city'] );
   update_post_meta($post_id,'_shipping_state', $_POST['_shipping_state'] );
   update_post_meta($post_id,'_shipping_postcode', $_POST['_shipping_postcode'] );
  
}


if ( empty( $subscription ) ) {
	global $wp;

	if ( ! isset( $wp->query_vars['view-subscription'] ) || 'shop_subscription' != get_post_type( absint( $wp->query_vars['view-subscription'] ) ) || ! current_user_can( 'view_order', absint( $wp->query_vars['view-subscription'] ) ) ) {
		echo '<div class="woocommerce-error">' . esc_html__( 'Invalid Subscription.', 'woocommerce-subscriptions' ) . ' <a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '" class="wc-forward">'. esc_html__( 'My Account', 'woocommerce-subscriptions' ) .'</a>' . '</div>';
		return;
	}

	$subscription = wcs_get_subscription( $wp->query_vars['view-subscription'] );
}

wc_print_notices();
?>
 
  <?php 
  
  wp_enqueue_style( 'slick_css', get_stylesheet_directory_uri().'/slick/slick.css', array(), '1.1', 'all');
  wp_enqueue_style( 'slick_css', get_stylesheet_directory_uri().'/slick/slick-theme.css', array(), '1.1', 'all');
  wp_enqueue_style( 'slick_csss', get_stylesheet_directory_uri().'/slick/slider.css', array(), '1.1', 'all');
 
  wp_enqueue_script( 'slick_script', get_stylesheet_directory_uri().'/slick/slick.min.js');
  wp_enqueue_script( 'slick_scripttt', get_stylesheet_directory_uri().'/slick/product-slider.js');
 
  ?>

    <?php if ( $notes = $subscription->get_customer_order_notes() ) :
	?>
	<h2><?php esc_html_e( 'Subscription Updates', 'woocommerce-subscriptions' ); ?></h2>
	<ol class="commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="comment note">
			<div class="comment_container">
				<div class="comment-text">
					<p class="meta"><?php echo esc_html( date_i18n( _x( 'l jS \o\f F Y, h:ia', 'date on subscription updates list. Will be localized', 'woocommerce-subscriptions' ), wcs_date_to_time( $note->comment_date ) ) ); ?></p>
					<div class="description">
						<?php echo wp_kses_post( wpautop( wptexturize( $note->comment_content ) ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>
<?php $allow_remove_items = wcs_can_items_be_removed( $subscription ); ?>
<h2><?php //esc_html_e( 'Subscription Totals', 'woocommerce-subscriptions' ); ?></h2>
<?php 
     if(sizeof( $subscription_items = $subscription->get_items() ) > 0 ) 
        {
    ?>
<div class="product-items-view" style="display:block;">			
				<?php
		

			foreach ( $subscription_items as $item_id => $item ) {
                            
                           
                            
				$_product  = apply_filters( 'woocommerce_subscriptions_order_item_product', $subscription->get_product_from_item( $item ), $item );
				if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
					?>
            
            
						<?php 
                                                
                                                $product_id = apply_filters( 'woocommerce_order_item_product_id', $item['product_id'], $item, $item_key );
                                                $product = new WC_product($productId);
                                            // echo    $product->get_image();?>
                                            
                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );?>

                                            
	
                                            
							
    <div class="product-item">
					
                                                    
                                                       <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>" >
                                                       <br>
      
							<?php
							if ( $_product && ! $_product->is_visible() ) {
								echo esc_html( apply_filters( 'woocommerce_order_item_name', $item['name'], $item, false ) );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item, false ) );
							}

							echo wp_kses_post( apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item ) );

							// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $subscription );

							wcs_display_item_meta( $item, $subscription );

							wcs_display_item_downloads( $item, $subscription );

							// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $subscription );
							?>
                                                       
                                                       <?php echo wp_kses_post( $subscription->get_formatted_line_subtotal( $item ) ); ?>
					
					<?php
				}

				?>
    </div>
			<?php }
		
	
?>
		
				
                          
</div>
				

		
<?php 
}

 

$order = new WC_Order($wp->query_vars['view-subscription']); // Order id


$shipping_address = $order->get_address('shipping'); 


//print_r($shipping_address);

//echo $thumbnail = apply_filters( 'woocommerce_order_item_thumbnail', $product->get_image(), $item, $item_key );






//print_r($order);



 //echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); 
				
//wc_get_template( 'order/order-details-customer-subscription.php', array( 'order' => $subscription ) ); ?>

<div class="clear"></div>
<div class="" style="width: 100%;margin:10px 0px;">
    <div class="" style="width: 30%;float:left;"><strong>Payment Date:</strong> <?php    echo date("F d,Y", strtotime( $subscription->schedule_next_payment));?></div>
    <div class="" style="width: 40%;float:left;"><strong>Shipping Address: </strong><?php echo $shipping_address['address_1']." ".$shipping_address['address_2']." ".$shipping_address['city']." " .$shipping_address['state'].", ".$shipping_address['postcode']." ".$shipping_address['country'];  // postcode //print_r($shipping_address);?></div>
      <div class="" style="width: 30%;float:left;"><strong>Payment Detail: </strong><?php  echo apply_filters( 'woocommerce_my_subscriptions_payment_method', $payment_method_to_display, $subscription );?></div>
</div>
<div class="clear"></div>

 <div style="width:100%;text-align:right;margin-top:20px;">
        <ul style="list-style-type: none;">
           <?php $actions = wcs_get_all_user_actions_for_subscription( $subscription, get_current_user_id() ); ?>
	<?php if ( ! empty( $actions ) ) : ?>
		      <li style="display:inline;" > <a class="button" id="toggle-update-address"  href="javascript:void(0)">update information</a></li>
                
				<?php foreach ( $actions as $key => $action ) :  //echo $key;
                                    if($key!=="change_payment_method" && $key!=="change_address")
                                    {
                                    ?>
                                  <li style="display:inline;" > 	
                                      <a href="<?php echo esc_url( $action['url'] ); ?>" class="button <?php echo sanitize_html_class( $key ) ?>"><?php echo esc_html( $action['name'] ); ?></a>
                                  </li>
				<?php 
                                    }
                                endforeach; ?>
			
	<?php endif; ?>
	<?php do_action( 'woocommerce_subscription_after_actions', $subscription ); ?>
        </ul>
	
           <!--  <ul style="list-style-type: none;">
                 <li style="display:inline;" > <a class="button" id="toggle-update-address"  href="javascript:void(0)">update information</a></li>
                 <li style="display:inline;"> <a href="#" class="button">Cancel Subscription</a></li>
                              
             </ul>-->
           
        </div>  

    
    
  

 <?php 
    $order_meta = get_post_meta( $wp->query_vars['view-subscription']);
    
   //print_r($order_meta);
    
   global $woocommerce;
$countries_obj   = new WC_Countries();
$countries   = $countries_obj->__get('countries');
$default_country = $countries_obj->get_base_country();
$default_county_states = $countries_obj->get_states( $default_country );


     
    ?>
  
<div id="div-update-address" class="" style="width: 100%;margin-top:30px;">
    <form action=""  class="edit-account" method="post">
    <div id="billing" style="width:50%;float:left;padding-right:10px;">
        


    <h2>Billing Address</h2>

   
     
     <p>
     <input type="text" id="_billing_address_1" name="_billing_address_1" placeholder="House number and street name" style="width:100%;color:#21140e" value="<?php echo $order_meta['_billing_address_1'][0];?>">
     </p>
     <p>
     <input type="text" id="_billing_address_2" name="_billing_address_2" placeholder="Apartment, suite, unit etc. (optional)" style="width:100%;color:#21140e" value="<?php echo $order_meta['_billing_address_2'][0];?>">
     </p>
      <p style="width: 32%;float: left;margin-right:1%;">
     <input type="text" id="_billing_city" name="_billing_city" placeholder="City" style="width:100%;color:#21140e" value="<?php echo $order_meta['_billing_city'][0];?>">
     </p>
      <p style="width: 32%;float: left;margin-right:1%;">
          <select id="_billing_state" name="_billing_state" class="state_select" style="width:100%;color:#21140e;min-width:100% !important;padding-top:6px !important;border: 2px solid #444;" >
               <option value="">Select State</option>
              <?php 
                
              foreach($default_county_states  as $key => $value)
              {
              
              ?>
              <option  <?php if($order_meta['_billing_state'][0]==$key) echo "selected='selected'";?> value="<?php echo $key;?>" ><?php echo $value;?></option>
              <?php }?>
              
          </select>
     </p>
      <p style="width: 33%;float: left;">
     <input type="text" id="_billing_postcode" name="_billing_postcode" placeholder="Postcode" style="width:100%;color:#21140e" value="<?php echo $order_meta['_billing_postcode'][0];?>">
     </p>
     
                 
    
    

  

    </div>
    
    
    <div id="shipping" style="width:50%;float:left;padding-right:10px;">
      


    <h2>Shipping Address</h2>

   <p>
     <input type="text" id="_billing_address_1" name="_shipping_address_1" placeholder="House number and street name" style="width:100%;color:#21140e" value="<?php echo $order_meta['_shipping_address_1'][0];?>">
     </p>
     <p>
     <input type="text" id="_billing_address_2" name="_shipping_address_2" placeholder="Apartment, suite, unit etc. (optional)" style="width:100%;color:#21140e" value="<?php echo $order_meta['_shipping_address_2'][0];?>">
     </p>
      <p style="width: 32%;float: left;margin-right:1%;">
     <input type="text" id="_shipping_city" name="_shipping_city" placeholder="City" style="width:100%;color:#21140e" value="<?php echo $order_meta['_shipping_city'][0];?>">
     </p>
      <p style="width: 32%;float: left;margin-right:1%;">
          <select id="_shipping_state" name="_shipping_state" class="state_select" style="width:100%;color:#21140e;min-width:100% !important;padding-top:6px !important;border: 2px solid #444;" >
               <option value="">Select State</option>
              <?php 
                
              foreach($default_county_states  as $key => $value)
              {
              
              ?>
              <option  <?php if($order_meta['_shipping_state'][0]==$key) echo "selected='selected'";?> value="<?php echo $key;?>" ><?php echo $value;?></option>
              <?php }?>
              
          </select>
     </p>
      <p style="width: 33%;float: left;">
     <input type="text" id="_shipping_postcode" name="_shipping_postcode" placeholder="Postcode" style="width:100%;color:#21140e" value="<?php echo $order_meta['_shipping_postcode'][0];?>">
     </p>
     <div style="width:100%;text-align:right;">
           <button type="submit"  class="button" value="Submit">Update</button>
        </div>  
    </div>
         </form> 
        <div class="card-details">
            <h2>Card Detail</h2>
            <?php
              $actions = wcs_get_all_user_actions_for_subscription( $subscription, get_current_user_id() );
              if ( ! empty( $actions['change_payment_method'] ) ) {
            ?>
            <div class="iframe-container">
              <iframe id="iframe-card-details" src="<?php echo esc_url( $action['url'] ); ?>" scrolling="no">
                <p>Your browser does not support iframes.</p>
              </iframe>
            </div>
            <?php
              }
            ?>
             <!--<p><input type="text" id="cc_name_on_card" placeholder="Name On Card"><p/>-->
            <!-- <p><input type="text" id="cc_name_card_number" placeholder="Card Number" style="width:100%;color:#21140e"><p/>
             <p><input type="text" id="cc_expire_date" placeholder="Expiry(MM/YY)" style="width:100%;color:#21140e"><p/>
               <p><input type="text" id="cc_cvc" placeholder="CVC" style="width:100%;color:#21140e"><p/>-->

               
               <?php 
             
               
//echo do_shortcode("[user_payment_method]");?>
        </div>
        <div class="clear">
          
                
        </div>
        
   <?php
   
        //print_r($order_meta);
   
   //$arr_params = array( 'pay_for_order' => 'true', 'key' => $order_meta['order_key'][0],'change_payment_method'=> $wp->query_vars['view-subscription']);
   //add_query_arg( $arr_params );
   
   $_GET['pay_for_order']='true';
   $_GET['key']=$order_meta['_order_key'][0];
   $_GET['change_payment_method']= $wp->query_vars['view-subscription'];
   
   
   //print_r($_GET);
   
   
   $subscription = wcs_get_subscription( absint( $wp->query_vars['view-subscription'] ) );
  // print_r($subscription);
//echo "hiii";
   
  

					$subscription_billing_country  = $subscription->get_billing_country();
					$subscription_billing_state    = $subscription->get_billing_state();
					$subscription_billing_postcode = $subscription->get_billing_postcode();

					// Set customer location to order location
					if ( $subscription_billing_country ) {
						$setter = is_callable( array( WC()->customer, 'set_billing_country' ) ) ? 'set_billing_country' : 'set_country';
						WC()->customer->$setter( $subscription_billing_country );
					}
					if ( $subscription_billing_state ) {
						$setter = is_callable( array( WC()->customer, 'set_billing_state' ) ) ? 'set_billing_state' : 'set_state';
						WC()->customer->$setter( $subscription_billing_state );
					}
					if ( $subscription_billing_postcode ) {
						$setter = is_callable( array( WC()->customer, 'set_billing_postcode' ) ) ? 'set_billing_postcode' : 'set_postcode';
						WC()->customer->$setter( $subscription_billing_postcode );
					}

$valid_request = true;
   ?>
</div>

<script type="text/javascript">
var timesRefreshed = 0;
jQuery("#toggle-update-address").addClass('disabled');

jQuery(document).ready(function($) {
//detect iframe loading/refreshing
  $("#iframe-card-details").load(function(){

      $(this).contents().find('#top-of-page, #custom-share-buttons, header, #mk-footer-unfold-spacer, #mk-footer, #theme-page-bg, .woocommerce-info, table.shop_table').hide();

      //if second refresh, change frame src - ie dont count first load
      if(timesRefreshed == 1){
          location.reload();
      }

      //add to times resreshed counter
      timesRefreshed++;

      jQuery("#toggle-update-address").removeClass('disabled');

  });
  $( window ).resize(function() {
    $("#iframe-card-details").height($("#iframe-card-details").contents().find('body').height());
  });
});
</script>
<!-- shipping form -->


