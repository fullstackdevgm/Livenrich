<div class="uap-ap-wrap">

<?php

if($_POST['is_resend']==1)
{
	resendInviteEmail($_POST);
	
}

 if (!empty($data['title'])):?>
	<h3><?php echo $data['title'];?></h3>
<?php endif;?>
<?php if (!empty($data['message'])):?>
	<p><?php echo do_shortcode($data['message']);?></p>
<?php endif;?>

<?php if (!empty($data['items']) && is_array($data['items'])):?>
	<div class="scroll-div">

	<?php echo $data['filter'];?>
		<table class="uap-account-table ss">
			  <thead>	
				<tr>
					<!--<th><?php _e("Campaign", 'uap');?></th>
					<th><?php _e("Amount", 'uap');?></th>	-->				
					<th><?php _e("親友識別號", 'uap');?></th>
					<th><?php _e("狀態", 'uap');?></th>
					<th><?php _e("採取行動", 'uap');?></th>
					<th><?php _e("邀請日期", 'uap');?></th>
					<!--<th><?php _e('Payment', 'uap');?></th>
					<th><?php _e("Status", 'uap');?></th>-->
					<th><?php _e("现金礼券点数", 'uap');?></th>
				</tr>
			  </thead>
			  <tbody class="uap-alternate">	
			  <?php $results=getInviteData();
			   if(count($results)>0 && $_GET['uap_list_item']<2)
			   {
				   foreach($results as $result){
			   
			  ?>
			  
			  <tr>
					<td> <span class="email"><?php echo $result->email;?></span></td>
					
					
					<td>未註冊</td>
					<td><form action="" method="post">
					<input type="hidden" name="email" value="<?php echo $result->email;?>"/>
					<input type="hidden" name="page_link" value="<?php echo $result->page_link;?>"/>
					<input type="hidden" name="url" value="<?php echo $result->url;?>"/>
					<input type="hidden" name="message" value="<?php echo $result->message;?>"/>
					<input type="hidden" name="is_resend" value="1"/>
					<input type="submit"  value="重新發送" class="button"/>
					</form></td>
					<td><?php echo date("m/d/Y", $result->created); ?></td>
                                    		
					<!--<td class="uap-special-label">
					 Not Signup
					</td>-->
					<td></td>
				</tr>
			  
			   <?php
				   }
			   } ?> 
			  
			<?php foreach ($data['items'] as $array) : if($array['description']==="User SignUp")  { // print_r($array); 
			$reward_point=getRefferalAmount($array['refferal_wp_uid']);
			?>
                              
				<tr>
					<td><span class="email"><?php 
						/*if ($array['campaign']) {
							echo $array['campaign'];
						} else {
							echo '-';
						}*/
                                        user_email_from($array['refferal_wp_uid']);
					?></span></td>
					<!--<td style="font-weight:bold; color:#111;"><?php echo uap_format_price_and_currency($array['currency'], $array['amount']);?></td>
					<td><?php echo (empty($array['source'])) ? '' : uap_service_type_code_to_title($array['source']);?></td>-->
					<td><?php if($reward_point>0) echo '已購買'; else echo $array['description'];?></td>
					<td></td>
					<td><?php
                                        echo date("m/d/Y", strtotime($array['date']));
                                        //echo uap_convert_date_to_us_format($array['date']);?></td>
					<!--<td><?php 
						switch ($array['payment']){
							case 0:
								_e('UnPaid', 'uap');
								break;
							case 1:
								_e('Pending', 'uap');
								break;
							case 2: 
								_e('Paid', 'uap');
								break;	
						}						
					?></td>
					<td class="uap-special-label"><?php 
						if ($array['status']==0){
							_e('Refuse', 'uap');
						} else if ($array['status']==1){
							_e('Unverified', 'uap');
						} else if ($array['status']==2){
							_e('Verified', 'uap');
						}
					?></td>-->
					<td><?php //echo $array['amount'];?> <?php echo $reward_point;?></td>
				</tr>
                        <?php } endforeach;?>
			</tbody>
		</table>
	</div>
<?php endif;?>








<?php if (!empty($data['pagination'])):?>
	<?php echo $data['pagination'];?>
<?php endif;?>


</div>