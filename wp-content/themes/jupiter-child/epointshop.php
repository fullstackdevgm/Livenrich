<?php /* Template Name: E-Point Shop */ ?>

<?php 
get_header();


Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

mk_build_main_wrapper( mk_get_view('singular', 'wp-page', true) );

?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $min_value = 1, $max_value = 99;

		var $product_names = $(".price_cart table .label a");
		var $products = $('<select id="custom_products"></select>');
		$product_names.each(function(i, checkbox){
		    var str = $product_names.eq(i).text();
		    $products.append($('<option>').val(str).text(str));
		});

		var $qtys = $('<select id="custom_qtys"></select>');
		var i = $min_value;
		while (i <= $max_value) {
			var str = i+" 張";
			$qtys.append($('<option>').val(str).text(str));
			i++;
		}

		var $qtys_input = $('<input type="number" id="custom_input_qtys" class="input-text qty text" min="'+$min_value+'" value="10" />');
		
		var $prices = $(".price_cart table .price .woocommerce-Price-amount");
		var $price = "<div id='custom_price'>"+$prices.first().text()+"</div>";

		var $clear = $('<div class="clear"></div>');

		var $custom = $("<div class='custom-e-points'></div>").append($products).append($qtys).append($qtys_input).append($price).append($clear);

		var $cart_button = $("<div class='custom-container'><button class='custom-add-to-cart'>加入購物車</button></div>");
		$($custom).insertAfter(".product-type-grouped .product_title.entry-title");
		$($cart_button).insertAfter(".product-type-grouped .summary .price_cart");
		$(".product-type-grouped .summary .social-share").appendTo(".product-type-grouped .custom-container");

		$("#custom_products").on('change', function() {
			var index = $(this).prop('selectedIndex');
			if($(this).val() == $("tr.post-732 label a").text()) {
				$("#custom_qtys").hide();
				//$("#custom_price").hide();
				$("#custom_input_qtys").show();
				$("#custom_price").text('$12');
				$(".cart").append('<input id="custom_price_eshop" type="hidden" name="custom_price_eshop" value="12"/>');
			} else {
				$("#custom_qtys").show();
				$("#custom_price").show();
				$("#custom_input_qtys").hide();
				$("#custom_price_eshop").remove();
				$("#custom_price").text($prices.eq(index).text());
			}
		});

		$(".custom-add-to-cart").on('click', function() {
			var selected_product = $("#custom_products").prop('selectedIndex');
			var selected_qty = $("#custom_qtys").prop('selectedIndex') + 1;
			if($(this).val() == "輸入 E分卡") {
				var cqty=1;
				$(".price_cart table tr").eq(selected_product).find("select.qty").val(cqty);
				$("button.single_add_to_cart_button").trigger("click");
				
			} else {
				$(".price_cart table tr").eq(selected_product).find("select.qty").val(selected_qty);
				$("button.single_add_to_cart_button").trigger("click");
			}
		});
		
		
		$("#custom_input_qtys").bind('keyup click', function () {
               var newval=1.2*parseInt($(this).val());   
              $("#custom_price").text('$'+newval);			   
              $("#custom_price_eshop").val(newval);			   
       });
		
		
		
	});
</script>

<?php
get_footer();
?>