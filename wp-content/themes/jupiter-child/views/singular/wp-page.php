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
	//$bundle=get_post_meta(747,'_yith_wcpb_bundle_data');
	$products=getBundleProducts(747);
		$product1 = get_product(747);
//var_dump($products);
      ?>
	  <div class="clear"></div>
	  
	<div class="bundle-list" id="p-747" style="display:none;">
	<form action="<?php //echo $product1->add_to_cart_url();?>" method="post" enctype="multipart/form-data">
	<!--<h3>Bundle內容</h3>-->
	<h3><?php echo $product1->get_name();?></h3>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				
				<th><?php _e( '商品', 'woocommerce' ); ?></th>
				<th><?php _e( '名称', 'woocommerce' ); ?></th>
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
		
			if(count($products)>0)
			{
				foreach($products as $product_id)
				{
					$product_loop=get_product($product_id);
					?>
					<tr>
					   <td>
					   <?php 
					   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
					   ?>
					   <img src="<?php  echo $image[0]; ?>" width="120"/>
					   </td>
						<!--<td>
							<?php 
							//echo '1';
							//$total_products=$total_products+1;
							
							?>
						</td>-->
					
						
						<?php if($product_id==747){?>
						<td>
						<input name="add-to-cart" value="747" type="hidden">
						<div class="quan-box"><div class="quantity_select">
							<select name="quantity" title="Qty" class="qty">
							<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>  </select>
						</div></div>
							</td>		
						<?php } else {?>
						      <td>
						       	<?php 
							         echo '1';
							         $total_products=$total_products+1;
							
							         ?>
						     </td>
						
						<?php } ?>	
	<td><?php echo $product_loop->get_name();?></td>						
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
						   <?php echo $point*1;?>
						</td>
						<td>
							
						<?php  
						/*if($product_id==747){
						echo WCS_ATT_Display::get_subscription_options_content( $product1 );
						
							
						}else{*/
						$price=get_post_meta($product_id,'_price',true); 
						  echo '$'.$price;
						  $total_price=$total_price+$price;
						/*}*/
						?></td>
						<td>
						<?php 
						
						if($product_id!=747){
					
							
						echo '$'.$price*1;	
						}
						?>
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
			  
			   <tr>
			   
			   <td colspan="2"><?php  echo WCS_ATT_Display::get_subscription_options_content( $product1 );?></td>
			  </tr> 
			 
			</table>
			
			<div class="clear"></div>
			<div class="bottom-buttons">
			<a class="button" href="">繼續購物</a>
			<!--<a class="button" style="margin-right:70px;" href="<?php echo $product1->add_to_cart_url();?>">結算</a>-->
			<input class="button" type="submit" value="結算"/>
		
			</div>
		   </form>
			
			</div>
			
			<div class="clear"></div>
			
	<?php		
//$products2=getBundleProducts(941);
$products2=getMixProducts(941);

$product2 = get_product(941);
//var_dump($products);
      ?>
	  <div class="clear"></div>
	  
	<div class="bundle-list" id="p-941" style="display:none;">
	<h3><?php echo $product2->get_name();?></h3>
	<p class="point-cal">*如果還沒達到<span id="pp">0</span>積分，則不能成功創造bundle</p>

		<form method="post" enctype="multipart/form-data" class="mnm_form cart cart_group">
		<div class="mixmatch-list">
		<ul>
		 <?php  if(count($products2)>0)
			{
				foreach($products2 as $product_id)
				{ 
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
		        $pdt = get_product($product_id);
				$unit_price=get_post_meta($product_id,'_price',true);	 

				?>
				  <li>
				     <img src="<?php  echo $image[0]; ?>" width="180"/>
					 <h4 class="product-name"><?php echo $pdt->get_name();?></h4>
					 <div class="price-point"><span class="price"><?php echo $pdt->get_price_html();?></span><span class="point"><?php 
							$point=get_post_meta($product_id,'_wc_points_earned',true);
						
							if($point=="" || $point==null)
							   $point=round(get_post_meta($product_id,'_price',true));
						  
						   echo $point.'pp';
						
						   ?></span>
						   </div>
					 	<div class="quan-box"><div class="quantity_select">
							<select name="mnm_quantity[<?php echo $product_id;?>]" title="Qty" class="qty" id="proqty-<?php echo $product_id;?>" onchange="updateSummaryTable();">
							<option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>  </select>
						</div></div>
					<input id="proprice-<?php echo $product_id;?>" type="hidden" name="product_price[<?php echo $product_id;?>]" value="<?php echo $unit_price;?>"/>
					<input id="propoint-<?php echo $product_id;?>" type="hidden" name="product_pp[<?php echo $product_id;?>]" value="<?php echo $point;?>"/>
					</li>
					
			<?php    }
			
			
			
			}?>
			</ul>
		
		
		</div>
		
		
			
			<div class="clear"></div>
				<table class="summary">
			  <tr>
			   <th>商 品 數 量： </th>
			   <td><span id="s-tproduct">0</span></td>
			  </tr>
			  <tr>
			   <th>總   積   分： </th>
			   <td><span id="s-tpoint">0</span></td>
			  </tr>
			  <tr>
			   <th>總   價   格： </th>
			   <td>$<span id="s-tprice">0</span></td>
			  </tr> 
			</table>
				<div class="clear"></div>
			<div class="bottom-buttons">
		
					
			<input name="add-to-cart" value="941" type="hidden">
			<input name="quantity" value="1" type="hidden">
			<input id="set-custom-price" name="custom_price" value="" type="hidden">
			<!--<input id="proprice-941" name="product_price[941]" value="900.00" type="hidden">
			<input id="proqty-941" name="mnm_quantity[941]" value="1" type="hidden">-->
			
	        <a class="button" href="">繼續購物</a>
			<input id="submit-mix" class="button mnm_add_to_cart_button" type="submit" value="結算"/>
		   
			</div>
		   </form>
			</div>
			
			<div class="clear"></div>
			
	
			

			
			
			<script>
			jQuery(document).ready(function() {
				jQuery('.post-747 a').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-747').show();
					
				});
				
				jQuery('.post-941 a').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-941').show();
					
				});
				
				
				jQuery('.post-840 .product-link').click(function(event){
					event.preventDefault();
					jQuery('.bundle-list').hide();
					jQuery('#p-840').show();
					
				});
				updateSummaryTable();
				/*var qty1=$('#proqty-520').val();
					var price1=$('#proprice-520').val();
					var point1=$('#propoint-520').val();
					*/
				
				
			});
              function updateSummaryTable()
				{
					
					var total_qty=0;
					var total_price=0;
					var total_point=0;
					<?php
					 foreach($products2 as $product_id)
				      { 
					  
					?>
					 var qty=parseInt(jQuery('#proqty-<?php echo $product_id;?>').val());
					 total_qty=total_qty+qty;
					 //total_price=total_price+parseFloat(jQuery('#proprice-<?php echo $product_id;?>').val())*qty;
					 total_price=total_price+parseInt(jQuery('#proprice-<?php echo $product_id;?>').val())*qty;
					 total_point=total_point+parseInt(jQuery('#propoint-<?php echo $product_id;?>').val())*qty;
					<?php } ?>
					
					jQuery('#s-tproduct').html(total_qty);
					jQuery('#s-tpoint').html(total_point);
					jQuery('#pp').html(total_point);
					jQuery('#set-custom-price').val(total_price);
					jQuery('#s-tprice').html(total_price+'.00');
					
					if(total_point<500)
						jQuery("#submit-mix").attr('disabled','disabled');
					else
						jQuery("#submit-mix").removeAttr('disabled');
				}
			</script>
		
		
      <?php
	}
	  
	    do_action('mk_page_after_content');
		?>
		<div class="clearboth"></div>
		<?php

	    wp_link_pages('before=<div id="mk-page-links">' . esc_html__( 'Pages:', 'mk_framework' ) . '&after=</div>');

	endwhile;
