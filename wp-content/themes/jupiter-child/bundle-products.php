<?php /* Template Name: Bundle Products */ ?>

<?php 
get_header();


Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

mk_build_main_wrapper( mk_get_view('singular', 'wp-bundle-page', true) );

?>

<div style="display: none;" class="loading-overflow"></div>
<div style="display: none;" class="loading-spinner"></div>

<?php
get_footer();
?>