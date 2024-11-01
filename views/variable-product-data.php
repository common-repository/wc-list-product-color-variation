<?php
/**
 * Custom product data on the general tab on WooCommerce Products
 */

global $woocommerce, $post;
?>
<div id="options_group_<?php echo WC_COLORPICKER_PLUGIN_SLUG; ?>" class="options_group">

    <h3><?php _e( 'Product color', WC_COLORPICKER_PLUGIN_SLUG ); ?></h3>


    <?php

    if(!empty(get_post_meta($variation->ID, WC_COLORPICKER_PLUGIN_SLUG . '-color-picker'))){
        $value = get_post_meta($variation->ID, WC_COLORPICKER_PLUGIN_SLUG . '-color-picker', true);
    }
    else {
        $value = '#f8f8f8';
    }

    woocommerce_wp_text_input( array(
        'id' => WC_COLORPICKER_PLUGIN_SLUG.'-color-picker',
        'value' => $value,
        'class' => 'my-input-class',
        //'name' => 'variable_color_picker_ckeckbox[]',
        'name' => WC_COLORPICKER_PLUGIN_SLUG.'-color-picker[' . $loop . ']',
        //'label' => __(' Choose product color: ', WC_COLORPICKER_PLUGIN_SLUG ),
        'desc_tip' => 'true',
        'description' => __( 'Välj färg', WC_COLORPICKER_PLUGIN_SLUG )
     ));

    ?>
    <?php


    ?>

</div>
