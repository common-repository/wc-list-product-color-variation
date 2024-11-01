<?php
	global $product, $post;
	$_variations = $product->get_available_variations();
	$attributes = $product->get_attributes();

	?>
	<div class="clearfix"></div>
	<form id="list-form" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>"method="post" enctype='multipart/form-data'>
		<input type="hidden" name="wc_color_list_add_to_cart"  />
	
		<div class="color-table" id="wc_color_list_product_variation">
		
		<?php 
		$i = 0;

		foreach ($_variations as $key => $value) {

			//Check if checkbox to change color is true. Then add color white to text
			if(get_post_meta($value['variation_id'], WC_COLORPICKER_PLUGIN_SLUG . '-text-color-checkbox', true) == 'yes' ){
				$text_color = 'white';
			}
			else $text_color = '#555';
		?>
			<input type="hidden" name="variation_id[]" value="<?php echo $value['variation_id'];?>" />
			<input type="hidden" name="product_id[]" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation[]" value="<?php print_r ( $value['attributes']); ?>" />

			<?php

			if(!empty($value['attributes'])){
				foreach ($value['attributes'] as $attr_key => $attr_value) {

				?>
				<input type="hidden" name="<?php echo $attr_key;?>" value="<?php echo $attr_value?>">
				<?php
				}
			}
			?>
			<div class="one-color-object">
			<table class="product-summary color-object" data-productvariation="<?php echo $value['variation_id'];?>">
				<tbody>
					<?php 	
						$currency = get_woocommerce_currency_symbol();
						$background = "";
						if(empty($value['image_src'])) {
						$wc_color_list_hex_code = get_post_meta($value['variation_id'], WC_COLORPICKER_PLUGIN_SLUG . '-color-picker', true);
						$background = "background-color: " . $wc_color_list_hex_code . ";";

						}
						else {
							$wc_color_list_hex_code = ''; 
							$background = "background: url(" . $value['image_src'] . ");";
						}
						$value_name = wc_attribute_label($attr_value);

						if(!empty($value_name)){?>

							<tr class="product-row" style="<?php echo $background; ?>" data-background="<?php echo $background; ?>" data-textcolor="<?php echo $text_color; ?>" data-colorname="<?php echo $value_name; ?>" data-currency="<?php echo $currency; ?>">
							<td>
							<p class="variable-color-text" style="color: <?php echo $text_color;?> "><?php echo $value_name;?></p><?php
						} else{ ?>
							<tr class="product-row" style="background-color: <?php echo $wc_color_list_hex_code; ?>" data-color="<?php echo $wc_color_list_hex_code; ?>" data-textcolor="<?php echo $text_color; ?>" data-colorname="<?php echo implode('/', $value['attributes']); ?>" data-currency="<?php echo $currency; ?>">
							<td>
							<p class="variable-color-text" style="color: <?php echo $text_color;?> "><?php echo implode('/', $value['attributes']);?></p><?php
						}
						?>
							
						</td>
						<td class="qty-field wc-color-list-qty" data-item="1" data-price="<?php echo $value['display_price'];?>" data-variation="<?php echo $value['variation_id'];?>">
							<?php 
								$args = array(
									'input_name' => 'quantity[]'
								);
								woocommerce_quantity_input( $args ); 
							?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>

		<?php
			$i++;
			}
		?>

		</div>
	</form>
	<div class="clearfix"></div>

<?php
