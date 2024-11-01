<?php
/**
 * Created by PhpStorm.
 * User: pelmered
 * Date: 13/05/15
 * Time: 09:39
 */

class WC_List_Color_Picker {


    function __construct() {

        //Set the color picker in the variations list. This is added with the variations. 
    	add_action( 'woocommerce_variation_options', array( $this, 'variable_color_picker_options_fields' ), 999, 3);
		add_action( 'admin_enqueue_scripts', array( $this, 'color_picker_assets' ));


        //Hook into product meta save action to save our custom fields.
        add_action( 'woocommerce_save_product_variation', array( $this, 'variable_product_options_fields_save' ), 10, 2);

        //Add a checkbox for the variable product and save if checked. This is displayed in the general options field.
		add_action( 'woocommerce_product_options_general_product_data', array( $this, "checkbox_option_color_picker"));
        add_action( 'woocommerce_process_product_meta', array( $this, 'checkbox_option_color_picker_save' ), 10, 2);

        //Add the checkbox and save if checked for textcolor in variations. This is displayed with the variations.
        add_action( 'woocommerce_variation_options', array( $this, 'checkbox_option_text_color' ), 999, 3);
        add_action( 'woocommerce_save_product_variation', array( $this, 'checkbox_option_text_color_save' ), 10, 2);

        


        //add_action( 'woocommerce_save_product_variation', $variation_id, $i );
    	  // add_action( 'woocommerce_product_options_general_product_data', array( $this, 'product_options_fields' ), 999);
    }


    //Add checkbox to have the opporunity to list the products.
    function checkbox_option_color_picker() {
                require(WC_COLORPICKER_PLUGIN_PATH . 'views/checkbox-variable-product.php');
    }

    function checkbox_option_color_picker_save($post_id, $post) {

        $fields = array(
            '-color-picker-checkbox'
        );

        foreach( $fields as $field ) {

            $field_data = sanitize_text_field( filter_input( INPUT_POST, WC_COLORPICKER_PLUGIN_SLUG . $field ) );
            
            if(!empty( $field_data ) ) {
                update_post_meta( $post->ID, WC_COLORPICKER_PLUGIN_SLUG . $field, $field_data );
            }
            else {
                delete_post_meta( $post->ID, WC_COLORPICKER_PLUGIN_SLUG . $field );
            }
        }

    }


    //Add color picker in the product variations and save the color for each variation
    function variable_color_picker_options_fields($loop, $variation_data, $variation ) {
    	require(WC_COLORPICKER_PLUGIN_PATH . 'views/variable-product-data.php');
	}

	function color_picker_assets($hook_suffix) {
	    // $hook_suffix to apply a check for admin page.
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wc-color-list-color-picker', WC_COLORPICKERs_PLUGIN_URL . 'js/wc-color-list-color-picker.js', array( 'wp-color-picker' ), false, true );
	}


    function variable_product_options_fields_save($variation_id, $i) {
        $fields = array(
            '-color-picker'
        );


        foreach( $fields as $field ) {

            $field_data = filter_input( INPUT_POST, WC_COLORPICKER_PLUGIN_SLUG . $field, FILTER_DEFAULT , FILTER_REQUIRE_ARRAY );
            
            if(!empty( $field_data[$i] ) ) {
                update_post_meta( $variation_id, WC_COLORPICKER_PLUGIN_SLUG . $field, $field_data[$i] );
            }
            else {
                delete_post_meta( $variation_id, WC_COLORPICKER_PLUGIN_SLUG . $field );
            }
        }
    }


    //Add checkbox for text color in product variations and save the data
    function checkbox_option_text_color($loop, $variation_data, $variation ) {
            require(WC_COLORPICKER_PLUGIN_PATH . 'views/checkbox-text-color-variable-product.php');
    }


    function checkbox_option_text_color_save($variation_id, $i) {

        $fields = array(
            '-text-color-checkbox'
        );

            foreach( $fields as $field ) {

                $field_data =  filter_input( INPUT_POST, WC_COLORPICKER_PLUGIN_SLUG . $field, FILTER_DEFAULT , FILTER_REQUIRE_ARRAY ) ;

                
                if(!empty( $field_data[$i] ) ) {
                    update_post_meta( $variation_id, WC_COLORPICKER_PLUGIN_SLUG . $field, $field_data[$i] );
                }
                else {
                    delete_post_meta( $variation_id, WC_COLORPICKER_PLUGIN_SLUG . $field );
                }
            }

    }



}