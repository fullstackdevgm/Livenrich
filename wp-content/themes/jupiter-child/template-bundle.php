<?php
/*
** Template Name: Bundle Page
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/

get_header();
WC_Account_Funds_Order_Manager::maybe_increase_funds(1174);exit;
global $mk_options;

if (have_posts()) 

	while (have_posts()):
    
	    the_post();
		
		do_action('mk_page_before_content');

	    the_content();

		

$bundle=get_post_meta(747,'_yith_wcpb_bundle_data');

?>
	<div class="bundle-list" id="p-747" style="display:none;">
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				
				<th></th>
				<th class="product-quantity"><?php _e( '數量', 'woocommerce' ); ?></th>
				
				<th class="product-point"><?php _e( '積分小計', 'woocommerce' ); ?></th>
				<th class="product-subtotal-point"><?php _e( '單位價格', 'woocommerce' ); ?></th>
				<th class="product-price"><?php _e( '單位積分', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php _e( '價格小計', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_point=0;
			$total_price=0;
			$total_products=0;
			if(count($bundle)>0)
			{
				foreach($bundle[0] as $bp)
				{
					$product_id=$bp['product_id'];
					?>
					<tr>
					   <td>
					   <?php 
					   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
					   ?>
					   <img src="<?php  echo $image[0]; ?>" width="120"/>
					   </td>
						<td>
							<?php echo $bp['bp_quantity'];
							$total_products=$total_products+$bp['bp_quantity'];
							
							?>
						</td>
						<td>
						<?php 
							$point=get_post_meta($product_id,'_wc_points_earned',true);
						
							if($point=="" || $point==null)
							   $point=round(get_post_meta($product_id,'_price',true));
						  
						   echo $point;
						  $total_point=$total_point+$point;
						   ?>
						</td>
						<td>
						   <?php echo $point*$bp['bp_quantity'];?>
						</td>
						<td><?php  
						$price=get_post_meta($product_id,'_price',true); 
						  echo '$'.$price;
						  $total_price=$total_price+$price;
						?></td>
						<td>
						
						 <?php echo '$'.$price*$bp['bp_quantity'];?>
						</td>
					</tr>
					
				
					
					<?php
				}
				
				
			}
			?>
			</tbody>
			</table>
			
			<table class="summary">
			  <tr>
			   <th>商 品 數 量： </th>
			   <td><?php echo $total_products;?></td>
			  </tr>
			  <tr>
			   <th>總   積   分： </th>
			   <td><?php echo $total_point;?></td>
			  </tr>
			  <tr>
			   <th>總   價   格： </th>
			   <td><?php echo '$'.$total_price;?></td>
			  </tr> 
			</table>
			<div class="clear"></div>
			<div class="bottom-buttons">
			<a class="button" href="#">繼續購物</a>
			<a class="button" style="margin-right:70px;" href="#">結算</a>
			</div>
			<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
			<script>
			jQuery(document).ready(function() {
				jQuery('.post-747').click(function(){
					jQuery('#p-747').show();
					
				});
			});

			</script>
<?php
		
		
	    do_action('mk_page_after_content');
		?>
		<div class="clearboth"></div>
		<?php

	     wp_link_pages('before=<div id="mk-page-links">' . esc_html__( 'Pages:', 'mk_framework' ) . '&after=</div>');

	endwhile;


 

get_footer();
?>

