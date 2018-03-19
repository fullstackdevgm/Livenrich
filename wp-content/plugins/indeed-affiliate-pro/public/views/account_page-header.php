<?php if (strpos($_SERVER['REQUEST_URI'], '?uap_aff_subtab') == false) {
   header("Location:".get_site_url()."/account-page/?uap_aff_subtab=epoint_history");
    exit;
}?>
<style>
<?php foreach ($data['available_tabs'] as $k=>$v):?>
	<?php echo '.fa-' . $k . '-account-uap:before';?>{
		content: '\<?php echo $v['uap_tab_' . $k . '_icon_code'];?>';
	}
<?php endforeach;?>	
</style>

<?php
$tabs = array(	
					'overview' => array(
						'type' => 'tab', 
						'label' => __('Overview', 'uap'), 
						'slug' => 'overview',
						'print_link' => TRUE,
						'icon_code' => '',
					),
    
					
					/*'order' => array(
						'type' => 'tab', 
						'label' => __('Order', 'uap'),
						'slug' => 'order',
						'print_link' => TRUE,
						'icon_code' => '',
					),*/
					
					/*'profile' => array(
						'type' => 'tab', 
						'label' => __('Profile', 'uap'), 
						'slug' => 'profile',
						'icon_code' => '',
						'print_link' => FALSE,						
						'children' => array(
											'edit_account' => array(
												'type' => 'subtab', 
												'label' => __('Edit Account', 'uap'),
												'slug' => 'edit_account',
												'icon_code' => '',
												'print_link' => TRUE,	
												'parent' => 'profile',
											),
                                                                                      
											'change_pass' => array(
												'type' => 'subtab', 
												'label' => __('Change Password', 'uap'),
												'slug' => 'change_pass',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'profile',
											),
											'payments_settings' => array(
												'type' => 'subtab', 
												'label' => __('Payment Settings', 'uap'), 
												'slug' => 'payments_settings',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'profile',
											),
											'custom_affiliate_slug' => array(
												'type' => 'subtab', 
												'label' => __('Custom Affiliate Slug', 'uap'), 
												'slug' => 'custom_affiliate_slug',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'profile',											
											),
											'pushover_notifications' => array(
												'type' => 'subtab', 
												'label' => __('Pushover Notifications', 'uap'), 
												'slug' => 'pushover_notifications',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'profile',									
											),
						),
					),*/
					/*'marketing' => array(
						'type' => 'tab', 
						'label' => __('Invite & Share', 'uap'), 
						'slug' => 'marketing',
						'print_link' => FALSE,
						'icon_code' => '',
						'children' =>	array(
											'affiliate_link' => array(
												'type' => 'subtab', 
												'label' => __('Affiliate Links', 'uap'), 
												'slug' => 'affiliate_link',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'marketing',
											),
					  						'simple_links' => array(
												'type' => 'subtab', 
												'label' => __('Simple Links', 'uap'), 
												'slug' => 'simple_links',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'marketing',
											),
					  						'campaigns' => array(
												'type' => 'subtab', 
												'label' => __('Campaigns', 'uap'), 
												'slug' => 'campaigns',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'marketing',
											),
											'banners' => array(
												'type' => 'subtab', 
												'label' => __('Banners', 'uap'), 
												'slug' => 'banners',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'marketing',
											),		
											'coupons' => array(
												'type' => 'subtab', 
												'label' => __('Coupons', 'uap'), 
												'slug' => 'coupons',
												'icon_code' => '',
												'print_link' => TRUE,
												'parent' => 'marketing',
											),											  	
						)
					),*/
					'referrals' => array(
						'type' => 'tab', 
						'label' => __('Statements', 'uap'), 
						'slug' => 'referrals',
						'print_link' => TRUE,
						'icon_code' => '',
					),			
					'payments' => array(
						'type' => 'tab', 
						'label' => __('Earnings', 'uap'), 
						'slug' => 'payments',
						'print_link' => TRUE,
						'icon_code' => '',
					),
					'wallet' => array(
						'type' => 'tab', 
						'label' => __('Wallet', 'uap'), 
						'slug' => 'wallet',
						'print_link' => TRUE,
						'icon_code' => '',
					),
					/*'reports' => array(
						'type' => 'tab', 
						'label' => __('Reports', 'uap'),
						'slug' => 'reports',
						'icon_code' => '',
						'print_link' => FALSE,
						'children' => array(
					  						'reports' => array(
												'type' => 'subtab', 
												'label' => __('OverAll', 'uap'), 
												'slug' => 'reports',
												'print_link' => TRUE,
												'icon_code' => '',
												'parent' => 'reports',
											),
					  					  	'visits' => array(
												'type' => 'subtab', 
												'label' => __('Traffic Log', 'uap'), 
												'slug' => 'visits',
												'print_link' => TRUE,
												'icon_code' => '',
												'parent' => 'reports',
											),
										  	'campaign_reports' => array(
												'type' => 'subtab', 
												'label' => __('Campaign Reports', 'uap'), 
												'slug' => 'campaign_reports',
												'print_link' => TRUE,
												'icon_code' => '',
												'parent' => 'reports',
											),
										  	'referrals_history' => array(
												'type' => 'subtab', 
												'label' => __('Referrals History', 'uap'), 
												'slug' => 'referrals_history',
												'print_link' => TRUE,
												'icon_code' => '',
												'parent' => 'reports',
											),
										  	'mlm' => array(
												'type' => 'subtab', 
												'label' => __('MLM', 'uap'), 
												'slug' => 'mlm',
												'print_link' => TRUE,
												'icon_code' => '',
												'parent' => 'reports',
											),
						)
					),*/
				    'referral_notifications' => array(
						'type' => 'tab', 
						'label' => __('Referral Notifications & Reports', 'uap'), 
						'slug' => 'referral_notifications',
						'print_link' => TRUE,
						'icon_code' => '',
					),
					'help' => array(
						'type' => 'tab', 
						'label' => __('Help', 'uap'), 
						'slug' => 'help',
						'print_link' => TRUE,
						'icon_code' => '',
					),
					'logout' => array(
						'type' => 'tab', 
						'label' => __('LogOut', 'uap'),
						'slug' => 'logout',
						'print_link' => TRUE,
						'icon_code' => '',
					),

						
);

foreach ($custom_menu as $temp_k=>$temp_arr){
	if (emptY($temp_arr['type'])){
		$custom_menu[$temp_k]['type'] = 'tab';
	}
}

$tabs = array_merge($tabs, $custom_menu);
$tabs = uap_reorder_menu_items($order, $tabs);


array_push($data['show_tab_list'],"order");
//array_unshift($data['show_tab_list'],"Epoint History");





$selected_parent = '';
foreach ($tabs as $first_slug => $array){
	/// exclude item
	if (in_array($first_slug, $exclude_tabs)){
		unset($tabs[$first_slug]);
		continue;
	} else if (isset($array['children'])){
		/// parent check
		foreach ($array['children'] as $children_slug => $children_array){
			if (in_array($children_slug, $exclude_tabs)){
				unset($tabs[$first_slug]['children'][$children_slug]);
			} else if (!in_array($children_slug, $data['show_tab_list'])){
				unset($tabs[$first_slug]['children'][$children_slug]);
			}
		}
		if (count($tabs[$first_slug]['children'])==0){
			unset($tabs[$first_slug]);
			continue;			
		}
	} else if (!in_array($first_slug, $data['show_tab_list'])){
		unset($tabs[$first_slug]);
		continue;
	}
	
	
	///// UPDATE MENU LABEL
	if (!empty($this->account_page_settings['uap_tab_' . $first_slug . '_menu_label'])){			
		$tabs[$first_slug]['label'] = $this->account_page_settings['uap_tab_' . $first_slug . '_menu_label'];
	}	
	
	
	if (!empty($tabs[$first_slug]['children'])){
		foreach ($tabs[$first_slug]['children'] as $second_slug => $second_array){
				
			/// exclude item
			if (in_array($second_slug, $exclude_tabs)){
				unset($tabs[$first_slug]['children'][$second_slug]);
				continue;
			} else if (!in_array($second_slug, $data['show_tab_list'])){
				unset($tabs[$first_slug]['children'][$second_slug]);
			}
			
			//// SET THE SELECTED PARENT
			if ($second_slug==$data['selected_tab']){
				$selected_parent = $second_array['parent'];
			}

			///// UPDATE MENU LABEL
			if (!empty($this->account_page_settings['uap_tab_' . $second_slug . '_menu_label'])){
				$tabs[$first_slug]['children'][$second_slug]['label'] = $this->account_page_settings['uap_tab_' . $second_slug . '_menu_label'];
			}
		}
	}
}
//// DO REORDER MENU ITEMS



?>



<div class="uap-user-page-wrapper">
<?php 
//print_r($data);
	$top_style='';
	if (empty($data['top-background']) && ($data['uap_ap_top_theme'] == 'uap-ap-top-theme-2' || $data['uap_ap_top_theme'] == 'uap-ap-top-theme-3' )) $top_style .='style="padding-top:75px;"'; ?>
	<div class="uap-user-page-top-wrapper desktop-display  <?php echo (!empty($data['uap_ap_top_theme']) ? $data['uap_ap_top_theme'] : '');?>" <?php echo $top_style;?>>
  
  <div class="uap-left-side">
	<div class="uap-user-page-details">
            
		<?php if (!empty($data['avatar'])):?>
			<div class="uap-user-page-avatar"><img src="<?php echo $data['avatar'];?>" class="uap-member-photo"/></div>
		<?php endif;?>
	 </div>
	</div>
	<div class="uap-middle-side">
            
          
		<div class="uap-account-page-top-mess">
                    <?php echo do_shortcode($data['message']);?>
                
                 <div class="uap-user-page-mess">
<ul>
 	<!--<li>當月累計業績 1200</li>
 	<li>尚需 2000 業績可獲得ABCD組每月獎勵</li>-->
       <li><?php if(!empty($data['rank']))echo $data['rank']['header_static_text_left'];?></li>
        <li>E分量  <?php echo do_shortcode("[get-account-funds]");?></li>
</ul>
</div>
                </div>	
		<?php if (!empty($data['top-rank']) && !empty($data['rank'])):?>
		<div class="uap-top-rank">
			<div class="uap-top-rank-box" style="background-color:#<?php echo $data['rank']['color'];?>;" title=""><?php echo $data['rank']['label'];?></div>
		
               
                </div>
		<?php endif;?>
               <!-- <span>Epoint Amount: <?php //echo do_shortcode('[get-account-funds]'); ?></span>-->
                <?php //if (function_exists('x3m_get_account_funds')) echo x3m_get_account_funds(); ?>
	</div>
	<div class="uap-right-side">
		<?php if (!empty($data['top-earning'])):?>
			<!--<div class="uap-top-earnings">
				<div class="uap-stats-label"><?php echo __('Earnings', 'uap'); ?></div>
				<div class="uap-stats-content"> <?php echo uap_format_price_and_currency($data['stats']['currency'], round($data['stats']['paid_payments_value']+$data['stats']['unpaid_payments_value'], 2)); ?></div>
			</div>-->
		<?php endif;?>
		<?php if (!empty($data['top-referrals'])):?>
			<!--<div class="uap-top-referrals">
				<div class="uap-stats-label"><?php echo __('Referrals', 'uap'); ?></div>
				<div class="uap-stats-content"> <?php echo $data['stats']['referrals']; ?></div>
			</div>-->
		<?php endif;?>
		<?php if (!empty($data['top-achievement']) && $data['achieved']>-1):?>
			<!--<div class="uap-clear uap-special-clear"></div>
			<div class="uap-top-achievement">
				<div class="uap-stats-label"><?php echo __('Until the next Rank...', 'uap'); ?></div>
				<div class="uap-achievement-line">
					<div class="uap-achieved" style="width:<?php echo $data['achieved']; ?>%;"></div>
				</div>
			</div>-->
		<?php endif;?>	
                        <div>
                            <p style="font-size:16px;text-align:right;line-height: 20px;margin-bottom: 5px;"><?php if(!empty($data['rank']))echo $data['rank']['header_static_text_right'];?><!--成為鑽石VIP尚需 <span style="color:#bd36ca;">8000</span> 積分<br> 或成功推薦 <span style="color:#bd36ca;">5</span> 位VIP會員--></p>
                        </div>
                        <div class="epoint-nav">
                            <ul style="list-style-type: none;">
                                <li style="display:inline;"> <a href="<?php echo get_site_url(); ?>/epoint-shop/">E分充值</a></li>
                                <li style="display:inline;" ><a href="<?php echo get_site_url(); ?>/account-page/?uap_aff_subtab=affiliate_link">邀请和分享</a></li>
                            </ul>
                           
                        </div>
		<div class="uap-clear"></div>
	</div>
	<div class="uap-clear"></div>
	<?php if (!empty($data['top-background'])):
  	$bk_style='';
	 if (!empty($data['top-background-image'])):
	 	$bk_style='style="background-image:url('.$data['top-background-image'].');"';	
	 endif;?>
  <div class="uap-user-page-top-background" <?php echo $bk_style;?>></div>
  <?php endif;?>

  
</div>
<div class="uap-user-page-content-wrapper <?php echo $data['uap_ap_theme'];?>">


<?php //=================================== TABS ====================================//?>


		<div class="uap-ap-menu desktop-display">
			<ul>
			
					<?php $i =1;?>
					
				<?php foreach ($tabs as $slug => $array) : ?>
			        <?php if ($array['type'] == 'tab'):
							if (!empty($array['children'])){
			        			if ($selected_parent==$slug){
			        				$extra_style = 'display: block';
			        				$i_class = 'fa-account-down-uap';			        				
			        			} else {
			        				$extra_style = '';	
			        				$i_class = 'fa-account-right-uap';
			        			}
								if ($data['uap_ap_theme']=='uap-ap-theme-1'){
									$action = "onClick=uap_show_subtabs('" . $slug . "');";
								} else {
									$action = "";
								}
								
			        ?>							
								<li class="uap-ap-submenu-item"><div class="uap-ap-menu-tab-item" <?php echo $action;?> ><a href="javascript:void(0);"><i class="uap-ap-menu-sign fa-uap <?php echo $i_class;?>" id="<?php echo 'uap_fa_sign-' . $slug;?>"></i><?php echo $array['label'];?></a></div>
									<ul class="uap-public-ap-menu-subtabs" style="<?php echo $extra_style;?>" id="<?php echo 'uap_public_ap_' . $slug;?>">
										<?php foreach ($array['children'] as $second_slug => $second_array): ?>
											<?php $extra_class = ($data['selected_tab']==$second_slug) ? 'uap-ap-menu-item-selected' : '';?>
											<li class="uap-ap-menu-item <?php echo $extra_class;?>"><a href="<?php echo $data['urls'][$second_slug];?>"><i class="<?php echo 'fa-uap fa-' . $second_slug . '-account-uap';?>"></i><?php 
			        						  	echo $second_array['label'];	
											?></a></li>
										<?php endforeach;?>	
									</ul>
								</li>
						<?php } else { ?>
					  		<?php $extra_class = ($data['selected_tab']==$slug) ? 'uap-ap-menu-tab-item-selected' : '';?>
							<?php 
							$order = $array['label'];
							if ($order == 'Order'){ ?>
	<li class="roderick uap-ap-menu-tab-item <?php echo $extra_class;?>"><a href="?uap_aff_subtab=orders"><i class="<?php echo 'fa-uap fa-' . $slug . '-account-uap';?>"></i><?php 
						  		echo $array['label'];
						  	?></a></li>							
							<?php 
							}else{ ?>
	<li class="roderick uap-ap-menu-tab-item <?php echo $extra_class;?>"><a href="<?php echo $data['urls'][$slug];?>"><i class="<?php echo 'fa-uap fa-' . $slug . '-account-uap';?>"></i><?php 
						  		echo $array['label'];
						  	?></a></li>								
							<?php }
							?>
							
						  	
						<?php }?>
						
					<?php endif; ?>	
					
				<?php endforeach;?>		
					
			</ul>
		</div>

<?php //=================================== TABS ====================================//?>
	<style>
	table th {  
    padding: 0px 12px;   
}
table td {
    text-align: center;
    padding: 0px;
	font-size:75%;
}

	</style>
	<?php if ($_GET['uap_aff_subtab'] == 'orders'){ ?>

	<div class="order-detail-user" style="margin-top:10px">
	<?php 
		echo do_shortcode( '[my_orders]' );
                
	?>
	</div>
	 <div class="order-subscription">
            <?php
              echo do_shortcode('[user_my_subscriptions]');
            ?>
        </div>
	<script>
	jQuery(document).ready(function(){	
		//jQuery('.view-order-tab').click(function(){			
			//jQuery('.order-detail-user').show();
			jQuery('.uap-user-page-content').hide();
			jQuery('.order-actions').hide();						
			jQuery('.order-detail-user h2').hide();						
			jQuery('.order-number a').attr('href','javascript:void(0)');						
		//});
	});
	</script>
	<?php } ?>
	
	<script>
	jQuery(document).ready(function(){		
		/* Add Link to marketing tab*/
		var hrefa=jQuery("#uap_public_ap_marketing li").find('a').attr('href');
		jQuery("#uap_fa_sign-marketing").parent("a").attr('href',hrefa);
		//alert (hrefa);
	});
	</script>
<div class="uap-user-page-content">
	