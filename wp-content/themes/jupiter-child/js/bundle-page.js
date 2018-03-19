jQuery(document).ready(function($) {
	if($('body').hasClass('page-template-bundle-products')) {
		window.isAMCartButton = false;
	}
	$(window).bind('load',function(){
        if(window.isAMCartButton == true) {
        	window.isAMCartButton = false;
        	window.location.href = myAjax.cart_url;
        }
    });
	$('.page-template-bundle-products .mk--row article, .page-template-bundle-products .mk--row article .button.mk-moon-cart-plus').on('click', function(e) {
		e.stopPropagation();
		e.preventDefault();

		$this_one = $(this);

		if($(this).hasClass('button')) {
			$this_one = $(this).closest('article');
		}

		var $pid = $this_one.find('input[id^="bundle-"]').val();
		var $count = $this_one.find('.qty').val();

		$(this).show_loading_spinner();
		$.ajax({
			url: myAjax.ajaxurl,
			type: 'post',
			data: { action: "group_product", 'product_id': $pid, 'product_count': $count},
			success: function(data, status) {
				$(this).hide_loading_spinner();
				if(status == "success") {
					$('#group_product_information').html(data);
					$('.point-cal .pointsval').text($('.summary .total-point').text().slice(0, -2));
					if(parseFloat($('.summary .total-point').text().slice(0, -2)) >= 500) {
						$("button.add-to-bundle").enable_add_to_cart();
					} else {
						$("button.add-to-bundle").disable_add_to_cart();
					}

					var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
					$("#hidden-bundle-"+bpid+" .wcsatt-options-wrapper").clone().appendTo(".wcsatt-options-td");

					$('#group_product_information .wcsatt-options-wrapper select > option').each(function() {
						if($(this).text() != "None") {
							var index = $(this).text().indexOf('every');
							if (index == -1) {
								index = $(this).text().indexOf('one');
							}
							$(this).text($(this).text().substring(index));
						}
					});

					$('#group_product_information').selectManager();
					$('#group_product_information').bundle_add_to_cart();
				}
			},
			error: function(xhr, desc, err) {
				$(this).hide_loading_spinner();
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
	});
	$(".page-template-bundle-products article .product-item-footer").on('click', function (event) {
		event.stopPropagation();
		event.preventDefault();
	});
	$.fn.selectManager = function() {
		var prevSelect = $('.bundle-list .qty, .mixmatch-list .qty').val();
		var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
		$('.bundle-list .qty').on('change', function() {
			if(parseFloat($(this).val()) >= 0) {
				var default_count = parseFloat($(this).parent().find('input[id^="default-"]').val());
				var prev_qty = parseFloat($(this).parent().find('input[id^="prevsel-"]').val());
				var qty = parseFloat($(this).val())-prev_qty;
				$(this).parent().find('input[id^="prevsel-"]').val($(this).val());
				var price = parseFloat($(this).parent().parent().find('td.unit-price').text().substring(1));
				var pp = parseFloat($(this).parent().parent().find('td.unit-point').text());
				var total_qty = parseFloat($('.summary .total-products').text()) + qty*default_count;
				var total_price = parseFloat($('.summary .total-price').text().substring(1)) + price*qty*default_count;
				var total_point = parseFloat($('.summary .total-point').text().slice(0, -2)) + pp*qty*default_count;

				if(total_point >= 500) {
					$("button.add-to-bundle").enable_add_to_cart();
				} else {
					$("button.add-to-bundle").disable_add_to_cart();
				}
				$('.summary .total-products').text(total_qty);
				$('.summary .total-price').text("$"+total_price);
				$('.summary .total-point').text(total_point + "pp");
				$('.point-cal .pointsval').text(total_point);
				$(this).parent().parent().find('td.sub-point').text(pp*(prev_qty + qty));
				$(this).parent().parent().find('td.sub-price').text("$" + price*(prev_qty + qty));
				if(parseFloat($(this).val()) == 0) {
					$(this).parent().parent().hide();
				}

				var pid = $(this).parent().parent().find('input[id^="bundleid-"]').val();
				var $match_data = $('#hidden-bundle-'+bpid+' div[data-product_id="'+pid+'"]');
				$match_data.find('select.qty').val($(this).val());
			} else {
				$(this).parent().parent().hide();
			}
		});

		$('.bundle-list .remove').on('click', function(e) {
			e.preventDefault();
			$(this).parent().parent().find('select.qty').val(0);
			$(this).parent().parent().find('select.qty').trigger("change");

			var pid = $(this).parent().parent().find('input[id^="bundleid-"]').val();
			var $match_data = $('#hidden-bundle-'+bpid+' div[data-product_id="'+pid+'"]');
			$match_data.parent().find('label').find('.bundled_product_checkbox').prop('checked', false);
		});
	}

	$.fn.bundle_add_to_cart = function() {
		$("#group_product_information .button.add-to-bundle").click(function(e){ 
		    e.preventDefault();  // Prevent the click from going to the link

		    var default_count = parseFloat($('input[id^="default-"]').first().val());
		    var sub_scheme = $('.summary .wcsatt-options-wrapper select').val();

		    var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
		    $('#hidden-bundle-'+bpid+' .wcsatt-options-wrapper select').val(sub_scheme);
		    $('#hidden-bundle-'+bpid+' .bundle_button select.qty').val(default_count);

		    $("#hidden-bundle-"+bpid+" .bundle_button button.bundle_add_to_cart_button").trigger( "click" );

		    window.isAMCartButton = true;
		});

		$("#group_product_information .mixmatch-list .button-cart .button.mk-moon-cart-plus").click(function(e){ 
		    e.preventDefault();  // Prevent the click from going to the link

	    	var qty = parseFloat($(this).parent().parent().find('select').val());
	    	var pid = $(this).parent().parent().find('input[id^="itemid-"]').val();
	    	var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
	    	if(qty > 0) {
	    		// Show the optional Products
	    		$this_one = $("#bundleid-" + pid);

	    		$this_one.parent().parent().show();
	    		$(this).parent().parent().find('select').val(0);
	    		var default_count = parseFloat($('input[id^="default-"]').first().val());
	    		var current_qty = parseFloat($this_one.parent().find(".qty").val());
	    		$this_one.parent().find(".qty").val(current_qty + qty);
	    		$('#prevsel-' + pid).val(current_qty + qty);

				var price = parseFloat($(this).parent().parent().parent().parent().find('input[id^="proprice-"]').val());
				var pp = parseFloat($(this).parent().parent().parent().parent().find('input[id^="propoint-"]').val());
				var total_qty = parseFloat($('.summary .total-products').text()) + qty*default_count;
				var total_price = parseFloat($('.summary .total-price').text().substring(1)) + price*qty*default_count;
				var total_point = parseFloat($('.summary .total-point').text().slice(0, -2)) + pp*qty*default_count;

				if(total_point >= 500) {
					$("button.add-to-bundle").enable_add_to_cart();
				} else {
					$("button.add-to-bundle").disable_add_to_cart();
				}
				$('.summary .total-products').text(total_qty);
				$('.summary .total-price').text("$"+total_price);
				$('.summary .total-point').text(total_point + "pp");
				$('.point-cal .pointsval').text(total_point);
				$this_one.parent().parent().find('td.sub-point').text(pp*(current_qty + qty));
				$this_one.parent().parent().find('td.sub-price').text("$" + price*(current_qty + qty));

				// Configure hidden bundle
				var $match_data = $('#hidden-bundle-'+bpid+' div[data-product_id="'+pid+'"]');
				$match_data.parent().find('label').find('.bundled_product_checkbox').prop('checked', true);
				$match_data.find('select.qty').val(current_qty + qty);
	    	}
		});

		$("#group_product_information .button.group-add-to-cart").click(function(e){ 
		    e.preventDefault();  // Prevent the click from going to the link

		    var default_count = parseFloat($('input[id^="default-"]').first().val());
		    var sub_scheme = $('.summary .wcsatt-options-wrapper select').val();

		    var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
		    $('#hidden-bundle-'+bpid+' .wcsatt-options-wrapper select').val(sub_scheme);
		    $('#hidden-bundle-'+bpid+' .bundle_button select.qty').val(default_count);

		    $("#hidden-bundle-"+bpid+" .bundle_button button.bundle_add_to_cart_button").trigger( "click" );

		    /*child_products = $('.mixmatch-list .qty');

		    child_products.each(function(id) {
		    	var qty = parseFloat($(this).val());
		    	var pid = $(this).parent().find('input[id^="itemid-"]').val();
		    	var bpid = $('.bottom-buttons input[id^="bundle-"]').val();
		    	if(qty > 0) {
		    		// Show the optional Products
		    		$this_one = $("#bundleid-" + pid);

		    		$this_one.parent().parent().show();
		    		$(this).val(0);
		    		var default_count = parseFloat($('input[id^="default-"]').first().val());
		    		var current_qty = parseFloat($this_one.parent().find(".qty").val());
		    		$this_one.parent().find(".qty").val(current_qty + qty);
		    		$('#prevsel-' + pid).val(current_qty + qty);

					var price = parseFloat($(this).parent().parent().parent().find('input[id^="proprice-"]').val());
					var pp = parseFloat($(this).parent().parent().parent().find('input[id^="propoint-"]').val());
					var total_qty = parseFloat($('.summary .total-products').text()) + qty*default_count;
					var total_price = parseFloat($('.summary .total-price').text().substring(1)) + price*qty*default_count;
					var total_point = parseFloat($('.summary .total-point').text().slice(0, -2)) + pp*qty*default_count;

					if(total_point >= 500) {
						$("button.add-to-bundle").enable_add_to_cart();
					} else {
						$("button.add-to-bundle").disable_add_to_cart();
					}
					$('.summary .total-products').text(total_qty);
					$('.summary .total-price').text("$"+total_price);
					$('.summary .total-point').text(total_point + "pp");
					$('.point-cal .pointsval').text(total_point);
					$this_one.parent().parent().find('td.sub-point').text(pp*(current_qty + qty));
					$this_one.parent().parent().find('td.sub-price').text("$" + price*(current_qty + qty));

					// Configure hidden bundle
					var $match_data = $('#hidden-bundle-'+bpid+' div[data-product_id="'+pid+'"]');
					$match_data.parent().find('label').find('.bundled_product_checkbox').prop('checked', true);
					$match_data.find('select.qty').val(current_qty + qty);
		    	}
		    });*/
		});
	}

	$.fn.xx_bundle_add_to_cart = function() {
		$("#group_product_information .button.add-to-bundle").click(function(e){ 
		    e.preventDefault();  // Prevent the click from going to the link

		    bundle_products = $('#group_product_information .bundle-list .qty');
		    var add_qty = 0;

		    var data = {
		    	'bundle': {
		    		'product_id': $(this).parent().find('input[id^="bundle-"]').val(),
		    		'qty': parseFloat($(this).parent().find('input[id^="bundlecnt-"]').val())
		    	}
		    };
		    add_qty += parseFloat($(this).parent().find('input[id^="bundlecnt-"]').val());

		    var bundle_items = {}

		    bundle_products.each(function(id) {
		    	if($(this).is(":visible")) {
			    	var bundle_product_id =  $(this).parent().find('input[id^="bundleid-"]').val();
			    	var bundle_qty = $(this).val();
			    	bundle_items[id] = {
			    		'product_id': bundle_product_id,
			    		'quantity': bundle_qty
			    	}
		    	}
		    });

		    data['bundle']['items'] = bundle_items;

		    $(this).show_loading_spinner();

		    $.ajax({
		    	url: myAjax.ajaxurl,
		    	method: 'post',
		    	data: { 
		    		action: 'mycart',
		    		'data': data
		    	},
		    	success: function(data, status) {
		    		$(this).hide_loading_spinner();
		    		if(status == "success") {
		    			var selected_option = $('.page-template-bundle-products .wcsatt-options-wrapper select').val();
		    			var data = {
							security:        myAjax.update_cart_option_nonce,
							selected_scheme: selected_option,
							action:          'wcsatt_update_cart_option'
						};

						/*$.post( myAjax.wc_ajax_url.toString().replace( '%%endpoint%%', 'wcsatt_update_cart_option' ), data, function( response ) {

							$('#page-section-2').append(response);*/

			    			var current_qty = $('.mk-shoping-cart-link .mk-header-cart-count').text();
			    			$('.mk-shoping-cart-link .mk-header-cart-count').text(parseFloat(current_qty) + add_qty);
			    			//window.location.href = myAjax.cart_url;
		    			/*});*/
		    		}
		    		console.log(data);
		    	},
		    	error: function(xhr, desc, err) {
		    		$(this).hide_loading_spinner();
		    		console.log(xhr);
		    		console.log("Details: " + desc + "\nError:" + err);
		    	}
		    });

		});

		$("#group_product_information .button.group-add-to-cart").click(function(e){ 
		    e.preventDefault();  // Prevent the click from going to the link

		    child_products = $('.mixmatch-list .qty');

		    child_products.each(function(id) {
		    	var qty = parseFloat($(this).val());
		    	var pid = $(this).parent().find('input[id^="itemid-"]').val();
		    	if(qty > 0) {
		    		$this_one = $("#bundleid-" + pid);

		    		$this_one.parent().parent().show();
		    		$(this).val(0);
		    		var current_qty = parseFloat($this_one.parent().find(".qty").val());
		    		$this_one.parent().find(".qty").val(current_qty + qty);
		    		$('#prevsel-' + pid).val(current_qty + qty);

					var price = parseFloat($(this).parent().parent().parent().find('input[id^="proprice-"]').val());
					var pp = parseFloat($(this).parent().parent().parent().find('input[id^="propoint-"]').val());
					var total_qty = parseFloat($('.summary .total-products').text()) + qty;
					var total_price = parseFloat($('.summary .total-price').text().substring(1)) + price*qty;
					var total_point = parseFloat($('.summary .total-point').text().slice(0, -2)) + pp*qty;

					$('.summary .total-products').text(total_qty);
					$('.summary .total-price').text("$"+total_price);
					$('.summary .total-point').text(total_point + "pp");
					$('.point-cal .pointsval').text(total_point);
					$this_one.parent().parent().find('td.sub-point').text(pp*(current_qty + qty));
					$this_one.parent().parent().find('td.sub-price').text("$" + price*(current_qty + qty));
		    	}
		    });
		});
	}

	$.fn.show_loading_spinner = function() {
		$('.loading-overflow').show();
		$('.loading-spinner').show();
	}

	$.fn.hide_loading_spinner = function() {
		$('.loading-overflow').hide();
		$('.loading-spinner').hide();
	}

	$.fn.enable_add_to_cart = function() {
		$(this).removeAttr("disabled");
		$(this).removeClass("disabled");
	}

	$.fn.disable_add_to_cart = function() {
		$(this).attr("disabled", "disabled");
		$(this).addClass("disabled");
	}
});