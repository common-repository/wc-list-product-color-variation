<?php
			global $product, $post;

			do_action( 'woocommerce_before_add_to_cart_form' ); 
			$variations = $product->get_available_variations();
			//if(get_post_meta($post->ID, WC_COLORPICKER_PLUGIN_SLUG . '-color-picker-checkbox', true) == 'yes'):
			?>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<div id="product_total_color">
				<!-- <input class="small-input-quantity-field" name="" value=""/> -->
			</div>
			<div class="add-to-cart-button">
				<button type="submit" onclick="document.getElementById('list-form').submit()" id="list-form-submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?></button>
			</div>
			<?php foreach ($variations as $key => $value) {
				//Check if checkbox to change color is true. Then add color white to text



			?>
				<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />


				<?php
				if(!empty($value['attributes'])){
					foreach ($value['attributes'] as $attr_key => $attr_value) {
					
					?>

					<input type="hidden" name="<?php echo $attr_key?>" value="<?php echo $attr_value?>">
					<?php
					}
				}
				?>
			<?php
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );
				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			}?>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				<?php do_action( 'woocommerce_after_variations_form' ); ?>


			<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

			<?php
?>