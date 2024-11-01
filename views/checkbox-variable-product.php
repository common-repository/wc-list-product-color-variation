<?php
/**
 * Custom product data on the general tab on WooCommerce Products
 */

global $woocommerce, $post;
?>
<div id="options_group_<?php echo WC_COLORPICKER_PLUGIN_SLUG; ?>" class="options_group show_if_variable">

    <h3><?php _e( 'List product variations', WC_COLORPICKER_PLUGIN_SLUG ); ?></h3>

    <?php

    woocommerce_wp_checkbox( array(
        'id' => WC_COLORPICKER_PLUGIN_SLUG.'-color-picker-checkbox',
        //'value' =>
        'class' => '',
       // 'name' => 'variable_color_ckeckbox',
        'label' => __(' List color products', WC_COLORPICKER_PLUGIN_SLUG ),
        'desc_tip' => 'true',
        'description' => __( 'If this is checked a list of the products will be displayed with a quantity input in the front end. This is instead of the default dropdown in your shop.', WC_COLORPICKER_PLUGIN_SLUG )
    )) ?>

    <?php

    ?>

</div>