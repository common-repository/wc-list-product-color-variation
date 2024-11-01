<?php
/**
 * Class SampleTest
 *
 * @package Wc_Color_List
 */

/**
 * Sample test case.
 */
class PluginTest extends WP_UnitTestCase {

	function test_woocommerce_available_variation() {


		$object = new WC_List_Color_Variation();

		$args = Array();

		$return = $object->woocommerce_available_variation( $args );

		$this->assertContains('max_qty', $return);
		$this->assertContains('min_qty', $return);

		$this->assertEquals($return['max_qty'], 10);
		$this->assertEquals($return['min_qty'], 0);
	}



}
