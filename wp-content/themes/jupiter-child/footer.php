<?php
$post_id = global_get_post_id();
if ($_SERVER['REQUEST_METHOD'] != 'POST' && $post_id==548)
{
	unset($_SESSION['e_point']);
	unset($_SESSION['r_point']);
	
}

global $mk_options;

$mk_footer_class = $show_footer = $disable_mobile = $footer_status = '';


if($post_id) {
  $show_footer = get_post_meta($post_id, '_template', true );
  $cases = array('no-footer', 'no-header-footer', 'no-header-title-footer', 'no-footer-title');
  $footer_status = in_array($show_footer, $cases);
}

if($mk_options['disable_footer'] == 'false' || ( $footer_status )) {
  $mk_footer_class .= ' mk-footer-disable';
}

if($mk_options['footer_type'] == '2') {
  $mk_footer_class .= ' mk-footer-unfold';
}


$boxed_footer = (isset($mk_options['boxed_footer']) && !empty($mk_options['boxed_footer'])) ? $mk_options['boxed_footer'] : 'true';
$footer_grid_status = ($boxed_footer == 'true') ? ' mk-grid' : ' fullwidth-footer';
$disable_mobile = ($mk_options['footer_disable_mobile'] == 'true' ) ? $mk_footer_class .= ' disable-on-mobile'  :  ' ';

?>

<section id="mk-footer-unfold-spacer"></section>

<section id="mk-footer" class="<?php echo $mk_footer_class; ?>" <?php echo get_schema_markup('footer'); ?>>
    <?php if($mk_options['disable_footer'] == 'true' && !$footer_status) : ?>
    <div class="footer-wrapper<?php echo $footer_grid_status;?>">
        <div class="mk-padding-wrapper">
            <?php mk_get_view('footer', 'widgets'); ?>
            <div class="clearboth"></div>
        </div>
    </div>
    <?php endif;?>
    <?php if ( $mk_options['disable_sub_footer'] == 'true' && ! $footer_status ) { 
        mk_get_view( 'footer', 'sub-footer', false, ['footer_grid_status' => $footer_grid_status] ); 
    } ?>
</section>
</div>
<?php 
    global $is_header_shortcode_added;
    
    if ( $mk_options['seondary_header_for_all'] === 'true' || get_header_style() === '3' || $is_header_shortcode_added === '3' ) {
        mk_get_header_view('holders', 'secondary-menu', ['header_shortcode_style' => $is_header_shortcode_added]); 
    }
?>
</div>

<form action="" method="post" id="epoint-form">
<input id="input-ep" type="hidden" name="ep" value="1"/>
</form>

<div class="bottom-corner-btns js-bottom-corner-btns">
<?php
    if ( $mk_options['go_to_top'] != 'false' ) { 
        mk_get_view( 'footer', 'navigate-top' );
    }
    
    if ( $mk_options['disable_quick_contact'] != 'false' ) {
        mk_get_view( 'footer', 'quick-contact' );
    }
    
    do_action('add_to_cart_responsive');
?>
</div>


<?php if ( $mk_options['header_search_location'] === 'fullscreen_search' ) { 
    mk_get_header_view('global', 'full-screen-search');
} ?>

<?php if (!empty($mk_options['body_border']) && $mk_options['body_border'] === 'true') { ?>
    <div class="border-body border-body--top"></div>
    <div class="border-body border-body--left border-body--side"></div>
    <div class="border-body border-body--right border-body--side"></div>
    <div class="border-body border-body--bottom"></div>
<?php } ?>

    <?php wp_footer(); 
	

	 
	
	
	
	
	
	?>
	<script>
	 function viewImageText(id,id2)
	 {
		id='#'+id;
		id2='#'+id2;
        jQuery('.clickimage-text .img-text').hide();
        jQuery(id).show();
		
		jQuery('.clickable-images a').removeClass('active');
		jQuery(id2).addClass('active');
            		
		 
		 
	 }
	 
	 
	/* jQuery('form.checkout').find('select.shipping_method, input[name^="shipping_method"]').change(function(){
		var val=jQuery(this).val();
		 var fund='<?php echo getCurrentUserAccountFund(); ?>';
		var html='<p class="custom-epoint"><input id="epoint-checkbox" type="checkbox" name="is_epoint" value="1"/><label>E Point </label><br/><span>Available balance:'+fund+'</span></p>';
		
		if(val=='flat_rate:8')
		{
			
			
			jQuery('form.checkout').addClass('has_shipping');
			jQuery("form.checkout #payment_method_stripe").prop("checked", true);

			jQuery("form.checkout #customer_details").append(html);
			
			
		}else
		{
			jQuery('form.checkout').removeClass('has_shipping');
			jQuery("form.checkout #customer_details .custom-epoint").remove();
		
		}
	 });
	 */
	 jQuery(document).ready(function() {
		 
			/*var check_val='<?php echo $_POST["ep"];?>'; 
		    var fund='<?php echo getCurrentUserAccountFund(); ?>';
		 
             var val=jQuery('form.checkout').find('select.shipping_method, input[name^="shipping_method"]:checked').val();
			
			 var html='<p class="custom-epoint"><input id="epoint-checkbox" type="radio" name="is_epoint" value="1"/><label>E Point </label><br/><span>Available balance:'+fund+'</span></p>';
		
			if(val=='flat_rate:8')
			{
				
				
			
				jQuery('form.checkout').addClass('has_shipping');
				jQuery("form.checkout #payment_method_stripe").prop("checked", true);

				jQuery("form.checkout #customer_details").append(html);
				if(check_val==1 || check_val=='1')
				jQuery("#epoint-checkbox").prop("checked", true);
				
			}
			 */
			 
			
			 /*jQuery('#epoint-checkbox').click(function(){
			  
			
			    if(jQuery('#epoint-checkbox').prop('checked') == true){
					 jQuery('#input-ep').val(1);
                   
                 }else
					  jQuery('#input-ep').val(2);
			
			       jQuery('#epoint-form').submit();
			 
		        });
			*/
			
			<?php
				if(isset($_GET['req']) && $_GET['req']==1)
				{ 
				$current_user = wp_get_current_user();
				
			    ?>
				   var username='<?php echo $current_user->user_login;?>';
					var ref=document.referrer+'?ref='+username;
					jQuery('#input_13_4-1-1').val(ref);
				<?php } ?>
	
			
		    	jQuery('#input_13_3').change(function(){
			  
			       var url=jQuery(this).val();
			      <?php $current_user = wp_get_current_user(); ?>
			      var username='<?php echo $current_user->user_login;?>';
				  var ref=url+'?ref='+username;
					jQuery('#input_13_4').val(ref);
				  
		        });
			
			  jQuery('#input_13_12').change(function(){
			  
			       var url=jQuery(this).val();
			      <?php $current_user = wp_get_current_user(); ?>
			      var username='<?php echo $current_user->user_login;?>';
				  var ref=url+'?ref='+username;
					jQuery('#input_13_11').val(ref);
				  
		        });
				jQuery('#input_13_17').change(function(){
			  
			       var url=jQuery(this).val();
			      <?php $current_user = wp_get_current_user(); ?>
			      var username='<?php echo $current_user->user_login;?>';
				  var ref=url+'?ref='+username;
					jQuery('#input_13_16').val(ref);
				  
		        });
				jQuery('#input_13_22').change(function(){
			  
			       var url=jQuery(this).val();
			      <?php $current_user = wp_get_current_user(); ?>
			      var username='<?php echo $current_user->user_login;?>';
				  var ref=url+'?ref='+username;
					jQuery('#input_13_21').val(ref);
				  
		        });
				jQuery('#input_13_27').change(function(){
			  
			       var url=jQuery(this).val();
			      <?php $current_user = wp_get_current_user(); ?>
			      var username='<?php echo $current_user->user_login;?>';
				  var ref=url+'?ref='+username;
					jQuery('#input_13_26').val(ref);
				  
		        });
			
			
			
			
			setTimeout(putFormHtml, 5000);
			
			
          });
		  
		 function putFormHtml(){
	
             <?php if(isset($_POST['r_amount']) && $_POST['r_amount']!="")
			  {
               
  		        ?>
		   
		  
				var rpoint='<?php echo $_POST['r_amount'];?>';
		        var epointhtml='<form class="epoint-input" action="" method="post"><input type="text" name="e_amount"><input type="hidden" name="ep" value="1"/><input type="hidden" name="form_type" value="epoint"/><input type="hidden" name="r_amount" value="'+rpoint+'"/><input class="button" type="submit" value="Confirm"/></form>';
            <?php  } 		       
			  else { ?>
				var epointhtml='<form class="epoint-input" action="" method="post"><input type="text" name="e_amount"><input type="hidden" name="ep" value="1"/><input type="hidden" name="form_type" value="epoint"/><input class="button" type="submit" value="Confirm"/></form>';
		   <?php  }  ?>

              <?php if(isset($_POST['e_amount']) && $_POST['e_amount']!="")
			  { ?>
				var epoint='<?php echo $_POST['e_amount'];?>';
		        var rewardhtml='<div class="payment_box payment_method_wallet" style="display:none;"><form class="epoint-input" action="" method="post"><input type="text" name="r_amount"><input type="hidden" name="ep" value="1"/><input type="hidden" name="form_type" value="rewardpoint"/><input type="hidden" name="e_amount" value="'+epoint+'"/><input class="button" type="submit" value="Confirm"/></form></div>';
			  <?php }
			  else { ?>
			 var rewardhtml='<div class="payment_box payment_method_wallet" style="display:none;"><form class="epoint-input" action="" method="post"><input type="text" name="r_amount"><input type="hidden" name="ep" value="1"/><input type="hidden" name="form_type" value="rewardpoint"/><input class="button" type="submit" value="Confirm"/></form></div>';
			  <?php } ?>
			
			
			
			
			
			
            
               
                <?php 
				if(isset($_POST['form_type']) && $_POST['form_type']!=""){ 
				
				  if($_POST['form_type']=='epoint'){
				?>  
				
				  jQuery('#payment_method_accountfunds').prop("checked", true );
				  jQuery('.payment_box.payment_method_stripe').hide();
				  jQuery('.payment_box.payment_method_accountfunds').show();
				<?php } else {?>
				
				 jQuery('#payment_method_wallet').prop("checked", true );
				  jQuery('.payment_box.payment_method_stripe').hide();
				  jQuery('.payment_box.payment_method_wallet').show();
				<?php 
				}
				
				} 
				
				?>
				
				
				
			jQuery('.payment_method_accountfunds .payment_box').append(epointhtml);
			jQuery('.wc_payment_methods .payment_method_wallet').append(rewardhtml);
				
				
			}
        
		
	
	jQuery('.menu-item-has-children a').stop(true).on('click', function(e) {

        //e.preventDefault();
      if(jQuery( window ).width()<850)
	  {
        var $this = jQuery(this);

        

        if ($this.hasClass('mk-nav-sub-closed')) {

            $this.siblings('ul').slideDown(450).end().removeClass('mk-nav-sub-closed').addClass('mk-nav-sub-opened');

        } else {

			 if ($this.hasClass('mk-nav-sub-opened')) {

            $this.siblings('ul').slideUp(450).end().removeClass('mk-nav-sub-opened').addClass('mk-nav-sub-closed');

			 }else

				$this.siblings('ul').slideDown(450).end().removeClass('mk-nav-sub-closed').addClass('mk-nav-sub-opened'); 

        }

		jQuery('.mk-responsive-wrap').addClass('force-show');
		
		setTimeout(function(){ jQuery('.mk-nav-responsive-link').addClass('is-active');jQuery('body').addClass('mk-opened-nav'); jQuery('body').removeClass('mk-closed-nav');}, 0);

	  }
		
    });
	
	jQuery('.mk-css-icon-menu').click(function(){
		
		jQuery('.mk-responsive-wrap').removeClass('force-show');
	});

	
	</script>
</body>
</html>