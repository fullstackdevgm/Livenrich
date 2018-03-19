jQuery(document).ready(function($) {
    //$('.woocommerce-cart input[name="update_cart"]').hide();
    $(".woocommerce").on("change", 'select.qty', function(){
        $('.woocommerce-cart input[name="update_cart"]').trigger("click");
    });
    $( document ).ajaxComplete(function() {
    	//$('.woocommerce-cart input[name="update_cart"]').hide();
    });
});