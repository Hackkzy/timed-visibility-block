<?php
/**
 * Renders the Timed Visibility Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 *
 * @package TimedVisibilityBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Get current time.
$current_time = current_time( 'timestamp' );

// Convert datetime strings to timestamps for comparison.
$visible_from  = ! empty( $attributes['visibleFrom'] ) ? strtotime( $attributes['visibleFrom'] ) : null;
$visible_until = ! empty( $attributes['visibleUntil'] ) ? strtotime( $attributes['visibleUntil'] ) : null;

if ( empty( $current_time ) || empty( $visible_from ) || empty( $visible_until ) ) {
	// If one of these empty, return.
	return;
}

if ( $current_time >= $visible_from && $current_time <= $visible_until ) {
	// Get Visibility type.
	$visibility_type = ! empty( $attributes['visibilityType'] ) ? $attributes['visibilityType'] : 'show';
	if ( 'show' === $visibility_type ) {
		echo wp_kses_post( $content );
	}
}
