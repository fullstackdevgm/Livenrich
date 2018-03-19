<link rel="stylesheet" href="http://cdn.jsdelivr.net/flexslider/2.1/flexslider.css">
<script src="http://cdn.jsdelivr.net/flexslider/2.1/jquery.flexslider-min.js"></script>


<div class="uap-banners-wrapp">

<?php if (!empty($data['title'])):?>
	<h3><?php echo $data['title'];?></h3>
<?php endif;?>
<?php if (!empty($data['message'])):?>
	<p><?php echo do_shortcode($data['message']);?></p>
<?php endif;?>
<div class="flexslider">
	<ul class="slides">
		
	<?php if (!empty($data['listing_items'])) : ?>
		<?php foreach ($data['listing_items'] as $arr) : ?>
		<li>
			<div class="uap-banner">
				<div class="uap-banner-title"><?php echo $arr->name;?></div>
				<div class="uap-banner-content">
					<div class="uap-banner-img">
					<span class="uap-ref-link"style="display:none;"><?php echo $arr->url; ?></span>
					<img class="custom-img" src="<?php echo $arr->image;?>" />
					<!--<a href="<?php echo $arr->url;?>" target="_blank">
						<img src="<?php echo $arr->image;?>" />
					</a>-->
					</div>
					<div class="banner-content">
					<div class="uap-banner-description"><?php echo __('Description:', 'uap') . ' ' . uap_correct_text($arr->description);?></div>
					<?php $size = uap_get_image_size($arr->image);?>
					<div><span class="uap-special-label"><?php echo __('Banner Size:', 'uap');?></span> <?php echo $size['width'] . 'px x ' . $size['height'] . 'px.';?></div> 
					<div><span class="uap-special-label"><?php echo __('Target URL:', 'uap');?></span> <?php echo $arr->url;?></div>
					
					<div class="uap-banner-copypaste">
						<div><strong style="color:#77; font-style:italic;"><?php _e('Copy & Paste this Source Code Into Your Website: ', 'uap');?></strong></div>
						<textarea><a href="<?php echo $arr->url;?>" target="_blank"><img src="<?php echo $arr->image;?>" /></a></textarea>			
					</div>
					</div>
				</div>
			</div>
		</li>	
		<?php endforeach;?>	
	<?php else : ?>

	<?php endif;?>
	</ul>
	</div>	
</div>
