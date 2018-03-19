<?php
/*
  Template Name: Redeem Confirmation
*/

get_header(); 


Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');


$user= wp_get_current_user();
global $mk_options;
global $post;

if (have_posts()) 

	while (have_posts()):
    
	    the_post();

		do_action('mk_page_before_content');

      ?>
	 <div id="theme-page" class="master-holder clearfix redeem-confirm-page">
	 <div class="master-holder-bg-holder">
				<div id="theme-page-bg" class="master-holder-bg js-el"></div>
			</div>
	  <div class="mk-main-wrapper-holder">
	     <div class="theme-page-wrapper full-layout   mk-grid">
	       <div class="theme-content ">
	          
				<section class="woocommerce-order-details">
					 <div class="address-summary">
					 <p>提交订单成功</p>
<p>您提交的订单已成功1我们将发送您的订单号到您的电子邮箱 </p>

                     <?php if($_GET['meta']=='yes'){?>
					   <p><?php echo currentUserShippingAddress();?></p>
					 
					 <?php } else {?> 
					 <p><b><?php echo $user->display_name;?></b></p>
					 <p><?php echo $_GET['st1'];?></p>
					 <p><?php echo $_GET['st2'].', '. $_GET['city'].', '.$_GET['state'].', '.$_GET['zip'];?></p>
					 <p><?php echo $_GET['email'];?></p>
					 <p><?php echo $_GET['phone'];?></p>
					 <?php } ?>
					 </div>

					<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

						<thead>
							<tr>
								<th class="product-thumbnail"><?php _e( 'Image', 'woocommerce' ); ?></th>
								<th class="product-quantity"><?php _e( 'Number of Product', 'woocommerce' ); ?></th>
							
								<th class="product-price"><?php _e( 'Amount', 'woocommerce' ); ?></th>
								
								
							</tr>
						</thead>

						<tbody>
							<tr>
							 <td><img src="http://envisionmt.org/liven/wp-content/uploads/2018/03/redeem.png" width="80"/></td>
							 <td>1</td>
							 <td><?php echo $_GET['amount'];?></td>
							
							
							</tr>
						</tbody>
				</table>
				<div class="summary">
				<table class="">
						<tfoot>
						
							<tr>
							  <th>Total products</th>
							  <td>1</td>
							</tr>
							
							
									<tr>
										<th scope="row">Total</th>
										<td><?php echo $_GET['amount'];?></td>
									</tr>
								
						</tfoot>
					</table>
				<!-- 	<div class="buttons">
					<a href="#" class="button">Button1</a>
					<a href="#" class="button">Button2</a>
					</div> -->
                </div>
					
				</section>
	       </div>
	     </div>
	  </div>
	 
	 </div>
	  
	
	  <?php
	    do_action('mk_page_after_content');
		

	endwhile;

?>


<script>



</script>


<?php 

get_footer();


?>