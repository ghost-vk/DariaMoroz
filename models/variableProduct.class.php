<?php
namespace MOROZ;

/**
 * Class VariableProduct
 * @package MOROZ
 */
class VariableProduct {
	private $id;
	private $product;
	
	
	/**
	 * Constructor
	 * @param $id {Integer}
	 */
	public function __construct( $id ) {
		$this->id = $id;
		$this->product = wc_get_product($id);
	}
	
	private function get_stock_ids() {
		$variations = $this->product->get_available_variations();
		$variations_id = wp_list_pluck( $variations, 'variation_id' );
		
		return $variations_id;
	}
	
	public function get_lowest_price() {
		var_dump( $this->get_stock_ids() );
	}
	
}