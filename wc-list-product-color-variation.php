<?php
/*
 * Plugin Name: WC List Product Color Variation
 * Plugin URI: 
 * Description: A plugin for listing color-based woocommerce products.
 * Version: 1.0
 * Author: Malin Kylegård
 **/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('WC_COLORPICKER_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('WC_COLORPICKERs_PLUGIN_URL', plugins_url('', __FILE__).'/');


define('WC_COLORPICKER_PLUGIN_SLUG', 'wc-color-list');


add_action( 'plugins_loaded', function() {

    require_once('includes/class-color-picker.php');
    require_once('includes/wc-color-list-color-variation.php');

    $GLOBALS['WC_List_Color_Picker'] = new WC_List_Color_Picker();
    $GLOBALS['WC_List_Color_Variation'] = new WC_List_Color_Variation();

});
