<div class="uap-ap-wrap">

<?php if (!empty($data['title'])):?>
	<h3><?php echo $data['title'];?></h3>
<?php endif;?>
<?php if (!empty($data['message'])):?>
	<p><?php echo do_shortcode($data['message']);?></p>
<?php endif;?>
 
<?php if (!empty($data['items']) && is_array($data['items'])):?>
	<div class="table-leftt  scroll-div">

	<?php echo $data['filter'];?>
		<table class="uap-account-table">
			  <thead>	
				<tr>
					<!--<th><?php _e("Campaign", 'uap');?></th>
					<th><?php _e("Amount", 'uap');?></th>	-->				
					<th><?php _e("From", 'uap');?></th>
                                        <th><?php _e("Date", 'uap');?></th>
					<th><?php _e("Order Id", 'uap');?></th>
					<th><?php _e("PP Point", 'uap');?></th>
					<th><?php _e("Amount", 'uap');?></th>
					<!--<th><?php _e('Payment', 'uap');?></th>-->
					<!--<th><?php _e("Status", 'uap');?></th>-->
				</tr>
			  </thead>
			  <tbody class="uap-alternate">	
			<?php foreach ($data['items'] as $array) :  //print_r($array); ?>
                              
				<tr>
					<td><?php 
						/*if ($array['campaign']) {
							echo $array['campaign'];
						} else {
							echo '-';
						}*/
                                        user_email_from($array['refferal_wp_uid']);
					?></td>
					<!--<td style="font-weight:bold; color:#111;"><?php echo uap_format_price_and_currency($array['currency'], $array['amount']);?></td>
					<td><?php echo (empty($array['source'])) ? '' : uap_service_type_code_to_title($array['source']);?></td>-->
					
					<td><?php
                                        echo date("m/d/Y", strtotime($array['date']));
                                        //echo uap_convert_date_to_us_format($array['date']);?></td>
                                        <td><?php echo $array['order_id']?></td>
                                        <td><?php echo $array['points']?></td>
                                         <td><?php echo $array['amount']?></td>
                                        
					
					
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="clear"></div>
<?php endif;?>

<?php if (!empty($data['pagination'])):?>
	<?php echo $data['pagination'];?>
<?php endif;?>
</div>

<div class="uap-ap-wrap">
	
<div class="table-left">


		<table class="uap-account-table">
			  <thead>	
				<tr>
					
                    <th><?php _e("Date", 'uap');?></th>
					<th><?php _e("Reward Amount Redeem", 'uap');?></th>
					<th><?php _e("Redeem Type", 'uap');?></th>
					
					
				</tr>
			  </thead>
			  <tbody class="uap-alternate">	
			<?php 
			$redeems=getAllRedeem();
			if(count($redeems)>0)
				 foreach($redeems as $redeem){
			?>
                              
				<tr>

					<td><?php echo date('m/d/Y',strtotime($redeem->date));?></td>
					<td><?php echo $redeem->amount;?></td>
					<td>
					<?php if($redeem->details=='Redeem Check')
					      echo 'Redeem Check';
					  else echo 'Redeem Product';?>
					
					</td>
					
                                        
					
					
				</tr>
				 <?php } ?>
			</tbody>
		</table>
	</div>
	<div class="table-right">
	  <a class="button" href="<?php bloginfo('url');?>/redeem-check/">Redeem Check</a>
	  <a class="button" href="<?php bloginfo('url');?>/all-product/">Redeem Product</a>
	
	</div>
	<div class="clear"></div>



</div>