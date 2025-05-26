<?php
/**
 * Common utility functions.
 *
 * @package TimedVisibilityBlock
 */

/**
 * Checks if the current time is within the time range.
 *
 * @param string $start_timestamp  Start datetime string.
 * @param string $end_timestamp End datetime string.
 * @param bool   $is_time_only Whether to compare only the time part. Default false.
 *
 * @return bool True if current time within range, else false.
 */
function timed_vblck_is_datetime_within_range( $start_timestamp, $end_timestamp, $is_time_only = false ) {

	// Get the WordPress timezone.
	$wp_timezone = wp_timezone();

	// If only time is being compared, remove the date part from the timestamps.
	if ( $is_time_only ) {
		$start_timestamp = ! empty( $start_timestamp ) ? preg_replace( '/^\d{4}-\d{2}-\d{2}T/', '', $start_timestamp ) : null;
		$end_timestamp   = ! empty( $end_timestamp ) ? preg_replace( '/^\d{4}-\d{2}-\d{2}T/', '', $end_timestamp ) : null;
	}

	// Create DateTime objects from timestamps, respecting the WordPress timezone.
	$start_datetime = ! empty( $start_timestamp ) ? new DateTime( $start_timestamp, $wp_timezone ) : null;
	$end_datetime   = ! empty( $end_timestamp ) ? new DateTime( $end_timestamp, $wp_timezone ) : null;

	// If start time is not valid.
	if ( empty( $start_datetime ) ) {
		return true;
	}

	// Get current time.
	$current_timestamp = current_time( 'mysql' );
	$current_datetime  = ! empty( $current_timestamp ) ? new DateTime( $current_timestamp, $wp_timezone ) : null;

	// If the current time is less than the start time, return false.
	if ( $current_datetime < $start_datetime ) {
		return false;
	}

	// If there is no end time selected, or the current time is less or equal to the end time, return true.
	if ( empty( $end_datetime ) || $current_datetime <= $end_datetime ) {
		return true;
	}

	// Otherwise, not within range.
	return false;
}
