<?php

/**
 * Template part for header toolbar. views/header/holders
 *
 * @author Artbees
 * @package jupiter/views
 * @since 5.0.0
 * @since 5.9.3 Add Polylang plugin check.
 */

global $mk_options;

?>

<div class="mk-header-toolbar">

	<?php if ( $mk_options['header_grid'] == 'true' ) { ?>
		<div class="mk-grid header-grid">
	<?php } ?>

		<div class="mk-toolbar-holder">

		<?php
 $user_id=get_current_user_id(); 
 $cuser=wp_get_current_user();
		do_action( 'header_toolbar_before' );

		if ( has_nav_menu( 'toolbar-menu' ) ) {
			mk_get_header_view( 'toolbar', 'nav' );
		}

		if ( ! empty( $mk_options['enable_header_date'] ) && $mk_options['enable_header_date'] === 'true' ) {
			mk_get_header_view( 'toolbar', 'date' );
		}

		if ( ! empty( $mk_options['header_toolbar_phone'] ) || ! empty( $mk_options['header_toolbar_email'] ) ) {
			mk_get_header_view( 'toolbar', 'contact' );
		}

		if ( ! empty( $mk_options['header_toolbar_tagline'] ) ) {
			mk_get_header_view( 'toolbar', 'tagline' );
		}

		if ( ( is_plugin_active( 'polylang/polylang.php' ) || defined( 'ICL_SITEPRESS_VERSION' ) ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
			mk_get_header_view( 'toolbar', 'language-nav' );
		}

		if ( ! empty( $mk_options['header_search_location'] ) && $mk_options['header_search_location'] === 'toolbar' ) {
			mk_get_header_view( 'global', 'search', [
				'location' => 'toolbar',
			] );
		}

		if ( ! empty( $mk_options['header_social_location'] ) && $mk_options['header_social_location'] === 'toolbar' ) {
			mk_get_header_view( 'global', 'social', [
				'location' => 'toolbar',
			] );
		}

		if ( ! empty( $mk_options['header_toolbar_login'] ) && $mk_options['header_toolbar_login'] === 'true' ) {
			mk_get_header_view( 'toolbar', 'login' );
		}

		if ( ! empty( $mk_options['header_toolbar_subscribe'] ) && $mk_options['header_toolbar_subscribe'] === 'true' ) {
			mk_get_header_view( 'toolbar', 'subscribe' );
		}

		do_action( 'header_toolbar_after' );

		global $indeed_db;
		
		// $current_rank_id = $indeed_db->get_affiliate_rank($this->affiliate_id);
		 $current_rank_id = $indeed_db->get_affiliate_rank(getAffiliateID($user_id));
			if(!empty($current_rank_id) && $current_rank_id>0){
				$current_rank = $indeed_db->get_rank($current_rank_id);
				
			}
		
		//var_dump($current_rank);
		
		?>

		</div>
		<div class="toolbar-userinfo mobile-display">
		
		<div class="uap-user-page-top-wrapper">
  
  <div class="uap-left-side">
	<div class="uap-user-page-details">
            <?php 
			
			$avatar = get_user_meta($user_id, 'uap_avatar', true);
				if (strpos($avatar, "http")===0){
					$avatar_url = $avatar;
				} else {
					$avatar_url = wp_get_attachment_url($avatar);
				}
				$avatar_url = ($avatar_url) ? $avatar_url : UAP_URL . 'assets/images/no-avatar.png';
			?>
		<div class="uap-user-page-avatar"><img src="<?php echo $avatar_url;?>" class="uap-member-photo"/></div>
		
	 </div>
	</div>
	<div class="uap-middle-side">
            
          
		<div class="uap-account-page-top-mess">
                    <?php //echo $current_rank->description;;?>
                <p class="uap-user-page-name"><?php echo $cuser->display_name;?> <span style="font-size: 18px;"><?php echo $current_rank['label'];?></span></p>
                 <div class="uap-user-page-mess">
<ul>

       <li><?php echo $current_rank['header_static_text_left'];?></li>
        <li>E分量  <span class="pur"><?php echo getCurrentUserAccountFund();?></span></li>
</ul>
</div>
                </div>	
		
		<!--<div class="uap-top-rank">
			<div class="uap-top-rank-box" style="background-color:#<?php echo $current_rank['color'];?>;" title=""><?php echo $current_rank['label'];?></div>
		
               
                </div>-->
		
              
	</div>
	
	<div class="uap-clear"></div>
<?php
$tab=$_GET["uap_aff_subtab"];
?>
 
  
  <div class="uap-ap-menu mobile-display">
			<ul>
			
				
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='epoint_history') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=epoint_history"><i class="fa-uap fa-epoint_history-account-uap"></i>目前E分余额</a></li>								
				   <li class="roderick uap-ap-menu-tab-item <?php if($tab=='monthly_report') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=monthly_report"><i class="fa-uap fa-monthly_report-account-uap"></i>當月累計業績</a></li>								
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='referrals_history') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=referrals_history"><i class="fa-uap fa-referrals_history-account-uap"></i>現金禮券點數</a></li>								
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='orders') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=orders"><i class="fa-uap fa-orders-account-uap"></i>訂購歷史</a></li>								
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='affiliate_link') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=affiliate_link"><i class="fa-uap fa-affiliate_link-account-uap"></i>邀請/分享</a></li>								
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='mlm') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=mlm"><i class="fa-uap fa-mlm-account-uap"></i>團隊</a></li>								
					<li class="roderick uap-ap-menu-tab-item <?php if($tab=='account_setting') echo 'uap-ap-menu-tab-item-selected';?>"><a href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=account_setting"><i class="fa-uap fa-account_setting-account-uap"></i>賬號設定</a></li>								
																			
	
			</ul>
				
					
			</ul>
		</div>
  
</div>
		
		
		</div>

	

</div>
