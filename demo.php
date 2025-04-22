<?php

defined( 'ABSPATH' ) || exit;

$order   = hivepress()->request->get_context( 'order' );
$original_booking_price = hivepress()->request->get_context( 'booking_price' );

$price_to_display = '';

if ( isset($booking) && is_a( $booking, '\HivePress\Models\Booking' ) ) {
    
    if ( $order && $order instanceof WC_Order ) {
        $price_to_display = wc_price( $order->get_subtotal() );
    } elseif ( $original_booking_price ) {
        $price_to_display = $original_booking_price;
    }
    
} else {
    $price_to_display = $original_booking_price ?? ''; 
}

if ( ! empty( $price_to_display ) ) :
?>
<div class="hp-booking__price hp-listing__attribute hp-listing__attribute--price">
    <?php echo $price_to_display; ?>
</div>
<?php
endif;

if ( isset($booking) && is_a( $booking, '\HivePress\Models\Booking' ) && get_option( 'hp_listing_allow_price_extras' ) && $booking->get_price_extras() ) :
	?>
	<div class="hp-listing__attribute hp-listing__attribute--price-extras">
		<?php echo esc_html( implode( ', ', array_column( $booking->get_price_extras(), 'name' ) ) ); ?>
	</div>
	<?php
endif;
