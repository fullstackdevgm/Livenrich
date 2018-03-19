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

		do_action('wp_ajax_bundle_page');

		?>
		<div id="group_product_information"></div>

		<?php 
		do_action('mk_page_after_content');
		?>

		<?php 
		$args = [
		    'post_type' => 'product',
		    'tax_query' => [
		        [
		            'taxonomy' => 'product_cat',
		            'terms' => 35,
		            'include_children' => false
		        ],
		    ],
		];
    	$posts = get_posts($args);
    	foreach ($posts as $key => $post) {
    		echo sprintf("<div id='hidden-bundle-%s'>%s</div>", $post->ID, do_shortcode('[product_page id="'.$post->ID.'"]'));
    	}
    	?>
		<div class="clearboth"></div>
		<?php

		wp_link_pages('before=<div id="mk-page-links">' . esc_html__( 'Pages:', 'mk_framework' ) . '&after=</div>');

	endwhile;
