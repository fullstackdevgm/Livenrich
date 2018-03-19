<?php
/**
* Content/view part for page.php
*
* @author 	Artbees
* @package 	jupiter/views
* @version     5.0.0
*/

global $mk_options;
global $post;

if (have_posts()) 

	while (have_posts()):
    
	    the_post();

		do_action('mk_page_before_content');

	    the_content();
	if($post->ID==808){
	$bundle=get_post_meta(747,'_yith_wcpb_bundle_data');

      ?>
	  <div class="clear"></div>
	  
	<div class="bundle-list" id="p-747" style="display:none;">
	<h3>Bundle內容</h3>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				
				<th><?php _e( '商品', 'woocommerce' ); ?></th>
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
					   <img src="<?php  echo $image[0]; ?>" width="60"/>
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
			</div>
			
			<div class="clear"></div>
			
			
			
		<?php	
	$bundle2=get_post_meta(832,'_yith_wcpb_bundle_data');

      ?>
	<div class="bundle-list" id="p-832" style="display:none;">
	<h3>Bundle內容</h3>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				
				<th><?php _e( '商品', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php _e( '數量', 'woocommerce' ); ?></th>
				
				<th class="product-point"><?php _e( '積分小計', 'woocommerce' ); ?></th>
				<th class="product-subtotal-point"><?php _e( '單位價格', 'woocommerce' ); ?></th>
				<th class="product-price"><?php _e( '單位積分', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php _e( '價格小計', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_point2=0;
			$total_price2=0;
			$total_products2=0;
			if(count($bundle2)>0)
			{
				foreach($bundle2[0] as $bp2)
				{
					$product_id2=$bp2['product_id'];
					?>
					<tr>
					   <td>
					   <?php 
					   $image2 = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id2), 'single-post-thumbnail' );
					   ?>
					   <img src="<?php  echo $image2[0]; ?>" width="60"/>
					   </td>
						<td>
							<?php echo $bp2['bp_quantity'];
							$total_products2=$total_products2+$bp2['bp_quantity'];
							
							?>
						</td>
						<td>
						<?php 
							$point2=get_post_meta($product_id2,'_wc_points_earned',true);
						
							if($point2=="" || $point2==null)
							   $point2=round(get_post_meta($product_id2,'_price',true));
						  
						   echo $point2;
						  $total_point2=$total_point2+$point2;
						   ?>
						</td>
						<td>
						   <?php echo $point2*$bp2['bp_quantity'];?>
						</td>
						<td><?php  
						$price2=get_post_meta($product_id2,'_price',true); 
						  echo '$'.$price2;
						  $total_price2=$total_price2+$price2;
						?></td>
						<td>
						
						 <?php echo '$'.$price2*$bp2['bp_quantity'];?>
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
			   <td><?php echo $total_products2;?></td>
			  </tr>
			  <tr>
			   <th>總   積   分： </th>
			   <td><?php echo $total_point2;?></td>
			  </tr>
			  <tr>
			   <th>總   價   格： </th>
			   <td><?php echo '$'.$total_price2;?></td>
			  </tr> 
			</table>
		
			<div class="clear"></div>
			</div>
			
				<?php	
	$bundle3=get_post_meta(840,'_yith_wcpb_bundle_data');

      ?>
	<div class="bundle-list" id="p-840" style="display:none;">
	<h3>Bundle內容</h3>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				
				<th><?php _e( '商品', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php _e( '數量', 'woocommerce' ); ?></th>
				
				<th class="product-point"><?php _e( '積分小計', 'woocommerce' ); ?></th>
				<th class="product-subtotal-point"><?php _e( '單位價格', 'woocommerce' ); ?></th>
				<th class="product-price"><?php _e( '單位積分', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php _e( '價格小計', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_point3=0;
			$total_price3=0;
			$total_products3=0;
			if(count($bundle3)>0)
			{
				foreach($bundle3[0] as $bp3)
				{
					$product_id3=$bp3['product_id'];
					?>
					<tr>
					   <td>
					   <?php 
					   $image3 = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id3), 'single-post-thumbnail' );
					   ?>
					   <img src="<?php  echo $image3[0]; ?>" width="60"/>
					   </td>
						<td>
							<?php echo $bp3['bp_quantity'];
							$total_products3=$total_products3+$bp3['bp_quantity'];
							
							?>
						</td>
						<td>
						<?php 
							$point3=get_post_meta($product_id3,'_wc_points_earned',true);
						
							if($point3=="" || $point3==null)
							   $point3=round(get_post_meta($product_id3,'_price',true));
						  
						   echo $point3;
						  $total_point3=$total_point3+$point3;
						   ?>
						</td>
						<td>
						   <?php echo $point3*$bp3['bp_quantity'];?>
						</td>
						<td><?php  
						$price3=get_post_meta($product_id3,'_price',true); 
						  echo '$'.$price3;
						  $total_price3=$total_price3+$price3;
						?></td>
						<td>
						
						 <?php echo '$'.$price3*$bp3['bp_quantity'];?>
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
			   <td><?php echo $total_products3;?></td>
			  </tr>
			  <tr>
			   <th>總   積   分： </th>
			   <td><?php echo $total_point3;?></td>
			  </tr>
			  <tr>
			   <th>總   價   格： </th>
			   <td><?php echo '$'.$total_price3;?></td>
			  </tr> 
			</table>
		
			<div class="clear"></div>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
			<div class="clear"></div>
			<div class="bottom-buttons">
			<a class="button" href="#">繼續購物</a>
			<a class="button" style="margin-right:70px;" href="#">結算</a>
			</div>
			
			
			
			
			
			
			
			
			<script>
			jQuery(document).ready(function() {
				jQuery('.post-747 .product-link').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-747').show();
					
				});
				jQuery('.post-832 .product-link').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-832').show();
					
				});
				
				
				jQuery('.post-840 .product-link').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-840').show();
					
				});
				
				
				
				
			});

			</script>
		
		
      <?php
	}
	  
	    do_action('mk_page_after_content');
		?>
		<div class="clearboth"></div>
		<?php

	    wp_link_pages('before=<div id="mk-page-links">' . esc_html__( 'Pages:', 'mk_framework' ) . '&after=</div>');

	endwhile;
