/**
	 * Gets cart profit.
	 *
	 * @param  WC_Cart $cart Cart object.
	 * @return float
	 */
	protected function get_cart_profit( $cart ) {
		$profit = 0;

		// Get item.
		$item = hp\get_first_array_value( $cart->get_cart() );

		if ( ! $item || ! isset( $item['hp_vendor'] ) ) {
			return $profit;
		}

		// Get vendor.
		$vendor = Models\Vendor::query()->get_by_id( $item['hp_vendor'] );

		if ( ! $vendor ) {
			return $profit;
		}

		// Get commissions.
		$commission_rate = $this->get_commission_rate( $vendor );
		$commission_fee  = $this->get_commission_fee( $vendor );

		// Get total.
		$total = $cart->get_subtotal();

		// Get profit.
		if ( $total ) {
			$profit = $total * $commission_rate - $commission_fee;
		}

		return $profit;
	}
