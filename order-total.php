<?php

defined( 'ABSPATH' ) || exit;

$display_value = '';

if ( isset( $order ) && is_object( $order ) && method_exists( $order, 'get_subtotal' ) ) {
	$subtotal = $order->get_subtotal();
	$display_value = '$' . $subtotal; 
} elseif ( isset( $order ) && is_object( $order ) && method_exists( $order, 'display_total' ) ) {
    $display_value = $order->display_total();
}

?>
<td class="hp-order__total">
	<span><?php echo esc_html( $display_value ); ?></span>
</td>
