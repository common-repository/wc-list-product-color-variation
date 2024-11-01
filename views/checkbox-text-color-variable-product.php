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
        'id' => WC_COLORPICKER_PLUGIN_SLUG.'-text-color-checkbox',
        'value' => get_post_meta($variation->ID, WC_COLORPICKER_PLUGIN_SLUG.'-text-color-checkbox', true),
        'class' => '',
        'name' => WC_COLORPICKER_PLUGIN_SLUG.'-text-color-checkbox[' . $loop . ']',
        'label' => __(' White text', WC_COLORPICKER_PLUGIN_SLUG ),
        'desc_tip' => 'true',
        'description' => __( 'If this is checked the text color will be white instead of black.', WC_COLORPICKER_PLUGIN_SLUG )
    )) ?>

    <?php

    ?>

</div>

