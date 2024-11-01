(function ($) {
  $(function () {
  	$( '#woocommerce-product-data' ).on( 'woocommerce_variations_loaded', function(){
	    $('.my-input-class').wpColorPicker( {
			change: _.throttle(function() {
				$(this).trigger( 'change' );
				$( 'button.save-variation-changes' ).removeAttr( 'disabled' );
			}, 3000)
		});

  	});

  

  });
}(jQuery));


