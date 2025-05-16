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

/**
 * Fires before rendering the Timed Visibility Block.
 *
 * @param array    $attributes Block attributes.
 */
do_action( 'timed_vblck_before_content', $attributes );

// Get visibility time attributes from block settings.
$visible_from  = ! empty( $attributes['visibleFrom'] ) ? $attributes['visibleFrom'] : null;
$visible_until = ! empty( $attributes['visibleUntil'] ) ? $attributes['visibleUntil'] : null;
$final_output  = '';

// If no visibility start time is set, always show content.
if ( empty( $visible_from ) ) {
	$final_output = $content;
} else {
	// Check if current time is within the specified range.
	$is_time_only    = ! empty( $attributes['timeOnly'] ) ? true : false;
	$is_within_range = timed_vblck_is_datetime_within_range( $visible_from, $visible_until, $is_time_only );
	$visibility_type = ! empty( $attributes['visibilityType'] ) ? $attributes['visibilityType'] : 'show';

	// Show content if within range and type is 'show', or if not within range and type is 'hide'.
	if ( $is_within_range && 'show' === $visibility_type ) {
		$final_output = $content;
	} elseif ( ! $is_within_range && 'hide' === $visibility_type ) {
		$final_output = $content;
	} else {
		// If content is hidden, check for a fallback message.
		$fallback_message = ! empty( $attributes['fallbackMessage'] ) ? (string) $attributes['fallbackMessage'] : '';

		if ( ! empty( $fallback_message ) ) {
			$fallback_content = sprintf(
				'<p>%s</p>',
				esc_html( $fallback_message )
			);

			/**
			 * Allow modification of the fallback content before output.
			 *
			 * @param string $fallback_content The fallback HTML content to display.
			 * @param string $fallback_message The original fallback message text.
			 */
			$final_output = apply_filters( 'timed_vblck_fallback_content', $fallback_content, $fallback_message );
		}
	}
}

// Output the final result, escaping for safe HTML.
echo wp_kses_post( $final_output );

/**
 * Fires after rendering the Timed Visibility Block.
 *
 * @param array    $attributes Block attributes.
 */
do_action( 'timed_vblck_after_content', $attributes );
