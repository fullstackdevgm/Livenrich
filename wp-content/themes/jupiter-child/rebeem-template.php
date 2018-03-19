<?php
/*
  Template Name: Redeem Page
*/

get_header(); 


Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

mk_build_main_wrapper( mk_get_view('singular', 'wp-page', true) );
?>


<script>
jQuery(document).ready(function(){
	
	var fund='<?php echo getCurrentUserRewardPointWallet();?>';
	jQuery('#rwp').text(fund);
	var shipping_address='<?php echo currentUserShippingAddress();?>';
	
	jQuery('#choice_14_13_1').val(shipping_address);
	jQuery('#label_14_13_1').text(shipping_address);
	
	
	
	var price=jQuery('#input_14_1').val();
		jQuery('#price-single').text(price);
		jQuery('#total-price').text('$'+price);
	
})

jQuery('#choice_14_13_1').click(function(){
	
  if (jQuery('#choice_14_13_1').prop('checked')==true){ 
	     jQuery('#input_14_15').val('yes');
	  }else
      	jQuery('#input_14_15').val('no');	  
	
});






jQuery('#gform_submit_button_14').click(function(event){
	event.preventDefault();
	
	address=jQuery('#input_14_7_1').val();
	city=jQuery('#input_14_7_3').val();
	state=jQuery('#input_14_7_4').val();
	email=jQuery('#input_14_10').val();
	phone=jQuery('#input_14_9').val();

	
	  if (jQuery('#choice_14_13_1').prop('checked')==true){ 
	     jQuery('#gform_14').submit();
	  }else{
	
		     if(address!="" && city!="" && state!="" && phone!="" && email!="")
		        jQuery('#gform_14').submit();
			 else
				  alert('please checked existing address or fill address below correctly');
	  }
	
})
</script>


<?php 

get_footer();


?>