<!DOCTYPE html>
<html <?php echo language_attributes();?> >
<head>
	<?php wp_head(); ?>
<script>jQuery(document).ready(function(){							setTimeout(function(){ 	var pos = jQuery('.page-id-668 .post-685.product.type-product').css('left');	jQuery('.page-id-668 .post-728.product.type-product').css('left',pos);	var pos = jQuery('.page-id-668 .post-712.product.type-product').css('left');	jQuery('.page-id-668 .post-729.product.type-product').css('left',pos);	var pos = jQuery('.page-id-668 .post-726.product.type-product').css('left');	jQuery('.page-id-668 .post-731.product.type-product').css('left',pos);	var pos = jQuery('.page-id-668 .post-727.product.type-product').css('left');	jQuery('.page-id-668 .post-732.product.type-product').css('left',pos);	jQuery('.page-id-668 .post-732.product.type-product').addClass('left');		console.log("Hello");	}, 1000);	

  var ht= jQuery( window ).height();
  var newht=ht-250;
  jQuery('#theme-page').css('min-height',newht);
	});</script>
</head>

<body <?php body_class(mk_get_body_class(global_get_post_id())); ?> <?php echo get_schema_markup('body'); ?> data-adminbar="<?php echo is_admin_bar_showing() ?>">

	<?php
		// Hook when you need to add content right after body opening tag. to be used in child themes or customisations.
		do_action('theme_after_body_tag_start');
	?>

	<!-- Target for scroll anchors to achieve native browser bahaviour + possible enhancements like smooth scrolling -->
	<div id="top-of-page"></div>

		<div id="mk-boxed-layout">

			<div id="mk-theme-container" <?php echo is_header_transparent('class="trans-header"'); ?>>

				<a id="custom-share-buttons" href="http://envisionmt.org/liven/account-page/?uap_aff_subtab=affiliate_link&req=1">
					<span class="share-text">分享</span>
				</a>

				<div class="hidden-user-avatar"><div class="edit-action"><div class="text">Edit</div></div><?php echo get_wp_user_avatar(get_current_user_id(), 300); ?></div>

				<div class="avatar-dialog-overlay"></div>
					<div class="avatar-dialog-box">
					<div class="avatar-content">
						<?php echo do_shortcode('[avatar_upload]'); ?>
						<a class="avatar-close button" href="#">Close</a>
					</div>
				</div>

				<?php
					if($_COOKIE['referral_name']) {
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						ulp_open('XcdzjNUh1ACJbemr');
					});
				</script>
				<?php
					}
				?>
				<?php mk_get_header_view('styles', 'header-'.get_header_style());