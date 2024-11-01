jQuery(function($){

       currency = '<?php echo "test" ?>';

        $('#wc_color_list_product_variation').on('click', '.qty', function() {
				// // Get elements and values
			var $this		= $(this),
		 		$qty		= $this.closest('.quantity').find('.qty'),
		 		currentVal	= parseFloat($qty.val());
				//color = 0;
			var color = $(this).closest('.qty-field').parent().data('color');
			var textcolor = $(this).closest('.qty-field').parent().data('textcolor');
			var colorname = $(this).closest('.qty-field').parent().data('colorname');
			var currency = $(this).closest('.qty-field').parent().data('currency');
			var background_image = $(this).closest('.qty-field').parent().data('background-image');
			var background = $(this).closest('.qty-field').parent().data('background');

			//console.log(this.value);
			var variation = $(this).closest('.qty-field').data( 'variation' );
			var product_variation = $(this).closest('.color-object').data( 'productvariation' );
			
			var variation_sum = $('[data-variation_id="'+variation+'"]');

			if(currentVal == 0){
				variation_sum.remove();
			}
			if(variation_sum.length > 0) {
				variation_sum.find('.quantity-value').text(currentVal);
				variation_sum.data('amount', currentVal);

			}
			else {
				if(currentVal === 0)
				{
					return;
				}
				//$('#product_total_price').append('<div class="small-color-quantity" data-variation_id="'+variation+'" style="background-color:'+color+'">' + currentVal + '</div>' );
				$('<div class="small-color-quantity" data-amount="'+currentVal+
					'" data-variation_id="'+variation+'" style="color:' + textcolor + 
					';' +background+';"><span class="quantity-value">' + 
					currentVal + '</span><div class="hover-controller"> x ' + " " +
					 colorname + '</div><div class=""></div></div>' 
					).appendTo($('#product_total_color'));
			}


			//calculate price total
			var total = 0;
	    	$('.color-object input').each(function(){    		
	    		var price = $(this).closest('.qty-field').data( 'price' );
	    		total += parseFloat(price * this.value);
	    	});
	    	$('#product_total_price .total-price').html(total.toFixed(2) + currency);

	    	var sum_items = 0;
	    	$('.color-object input').each(function(){    		
	    		var item = $(this).closest('.qty-field').data( 'item' );
	    		sum_items += parseFloat(item * this.value);
	    	});
	    	$('#product_total_items .total-items').html(sum_items);

		});


});




