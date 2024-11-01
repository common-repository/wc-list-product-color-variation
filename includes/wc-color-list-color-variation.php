<?php 

class WC_List_Color_Variation {


    function __construct()
    {
    	add_action('init', array($this, 'init'), 30);
    	add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
    	add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ));

    }

    function init() {

    	//global $product, $post;
    	//$this->add_to_cart();
    	add_action('template_redirect', array($this, 'wc_color_list_init'));
    	add_action( 'woocommerce_cart_loaded_from_session', array($this, 'add_to_cart'));

    }


    	/**
	 * Register and enqueue style sheet.
	 */
	public function register_plugin_styles() {
		wp_register_style( 'product_variation', WC_COLORPICKERs_PLUGIN_URL . '/assets/style.css' );
		wp_enqueue_style( 'product_variation' );
	}

	public function register_plugin_scripts() {
		wp_enqueue_script( 'variation-color-picker-script',  WC_COLORPICKERs_PLUGIN_URL . '/js/wc-color-list-color-picker.js' );
		wp_enqueue_script( 'variation-product-sum-script',  WC_COLORPICKERs_PLUGIN_URL . '/js/product-total-sum.js' );
	}



    function wc_color_list_init(){

    	if(get_post_meta(get_the_id(), WC_COLORPICKER_PLUGIN_SLUG . '-color-picker-checkbox', true) != 'yes'){
    		return 0;
    	}

    	//Remove the nhook where the variable products are added
    	remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );

    	//Remove the quantity and the add to cart button fetched from woocommerce single variation
		remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

		//Add function to list all the product variables available for cart
		add_action('woocommerce_after_single_product_summary', array($this, 'list_product_variations'), 5, 2);	
		add_action('woocommerce_variable_add_to_cart', array($this, 'add_to_cart_variations'), 30, 2);	

		//Add filter to manipulate the input arguments to change the quantity of the products
		add_filter( 'woocommerce_quantity_input_args', array($this, 'woocommerce_quantity_input_args'), 10, 2 );

		//Add filter for the max and minimum of the quantity can be purchased of the variable products.
		add_filter( 'woocommerce_available_variation', array($this, 'woocommerce_available_variation'));

		//Add the total price of the variable products where quantity is > 1
		add_action( 'woocommerce_before_add_to_cart_form', array($this, 'total_product_price'), 31 );

    }

    // A function which get the products variable information and add the variations to the cart when add to cart button is pressed.
	function add_to_cart() {
			
		if( isset( $_POST['wc_color_list_add_to_cart'])) {

			$cart = WC()->cart;
			
			
			$variation_ids = $_POST['variation_id'];
			$quantity = $_POST['quantity'];
			$product_ids = $_POST['product_id'];
			$variation = $_POST['variation'];
			$new_variation = array();

			foreach ($variation as $str) {

				$keys = array();
		        $values = array();
		        $output = array();

		        //Is it an array?
		        if( substr($str, 0, 5) == 'Array' ) {

		            //Let's parse it (hopefully it won't clash)
		            $array_contents = substr($str, 7, -2);
		            $array_contents = str_replace(array('[', ']', '=>'), array('#!#', '#?#', ''), $array_contents);
		            $array_fields = explode("#!#", $array_contents);

		            //For each array-field, we need to explode on the delimiters I've set and make it look funny.
		            for($i = 0; $i < count($array_fields); $i++ ) {

		                //First run is glitched, so let's pass on that one.
		                if( $i != 0 ) {

		                    $bits = explode('#?#', $array_fields[$i]);
		                    if( $bits[0] != '' ) $output[$bits[0]] = $bits[1];

		                }
		            }

			            //Return the output.
			            $new_variation[] = $output;
			        }

			}
			
			if( is_array($variation_ids) && is_array($quantity) ) {

				foreach( $variation_ids as $key => $variation_id ) {
					if($quantity[$key] > 0):
						WC()->cart->add_to_cart($product_ids[$key], $quantity[$key], $variation_id, $new_variation[$key]);

					endif;
					
				}
				
				wc_add_notice( __( 'Your products was successfully added to cart.', 'woocommerce-gateway-payiq' ), 'success' );
			}
			
		}
	}

	//List of the variable products, in this case the colors. 
	function list_product_variations() {
		require_once(WC_COLORPICKER_PLUGIN_PATH . 'templates/list-product-variation.php');

	}

	function add_to_cart_variations(){
		require_once(WC_COLORPICKER_PLUGIN_PATH . 'templates/add-to-cart-variation.php');
	}


	// Set the quantity default value to 0 and add the maximum and minimum quantity

	function woocommerce_quantity_input_args( $args, $product ) {
		if ( is_singular( 'product' ) ) {
			$args['input_value'] 	= 0;	// Starting value (we only want to affect product pages, not cart)
		}
		$args['max_value'] 	= 400; 	// Maximum value
		$args['min_value'] 	= 0;   	// Minimum value
		$args['step'] 		= 1;    // Quantity steps
		return $args;
	}

	// Variations


	function woocommerce_available_variation( $args ) {
		$args['max_qty'] = 10; 		// Maximum value (variations)
		$args['min_qty'] = 0;   	// Minimum value (variations)
		return $args;
	}

	//Calculate the total sum of all the product variation where the quantity is changed

	function total_product_price() {
	    global $woocommerce, $product;
	   	$currency = get_woocommerce_currency_symbol();
	   	$sum_items = '0';
		$sum_zero = "0.00" . $currency;

		echo sprintf('<div id="product_total_items" style="margin-bottom:5px">%s%s %s</div>',__('Quantity','woocommerce'),':','<span class="total-items">'.$sum_items.'</span>');
	    echo sprintf('<div id="product_total_price" data-currency="<?php echo $currency; ?>" style="margin-bottom:20px">%s%s %s</div>',__('Total','woocommerce'),':','<span class="total-price">'.$sum_zero.'</span>');
	   	

	    ?>

	    <?php
	}

}
